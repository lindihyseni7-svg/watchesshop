<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Repositories\AdminRepository;
use App\Repositories\UserRepository;
use App\Services\CartService;
use App\Services\FavoriteService;
use mysqli_sql_exception;

// Central admin controller for dashboard plus configured CRUD modules.
final class AdminController
{
    private array $entities;

    public function __construct(private readonly AdminRepository $repository = new AdminRepository())
    {
        $this->entities = $this->entityConfiguration();
    }

    public function dashboard(): void
    {
        require_admin();
        render('admin/dashboard', $this->shared([
            'title' => 'Admin Dashboard | Watches Prishtina',
            'counts' => $this->repository->counts(),
        ]));
    }

    public function index(string $entity): void
    {
        require_admin();
        $config = $this->config($entity);
        render('admin/list', $this->shared([
            'title' => $config['label'] . ' | Admin',
            'entity' => $entity,
            'config' => $config,
            'rows' => $this->repository->all($config['table'], $config['primary_key']),
        ]));
    }

    public function form(string $entity, ?int $id = null, array $errors = [], array $old = []): void
    {
        require_admin();
        $config = $this->config($entity);
        $record = $id ? $this->repository->find($config['table'], $config['primary_key'], $id) : null;
        if ($id && !$record) {
            flash('error', 'Regjistrimi nuk u gjet.');
            redirect('admin/' . $entity);
        }

        render('admin/form', $this->shared([
            'title' => ($id ? 'Modifiko ' : 'Shto ') . $config['singular'] . ' | Admin',
            'entity' => $entity,
            'config' => $config,
            'record' => array_merge($record ?? [], $old),
            'recordId' => $id,
            'errors' => $errors,
            'dynamicOptions' => $this->dynamicOptions($config),
        ]));
    }

    public function save(string $entity, ?int $id = null): void
    {
        require_admin();
        verify_form_csrf();
        $config = $this->config($entity);
        $data = [];
        $errors = [];

        foreach ($config['fields'] as $column => $field) {
            $value = trim((string) ($_POST[$column] ?? ''));
            if (($field['required'] ?? false) && $value === '' && !($entity === 'users' && $id && $column === 'fjalekalimi')) {
                $errors[$column] = 'Kjo fushe eshte e detyrueshme.';
            }
            if (($field['type'] ?? '') === 'number' && $value !== '' && !is_numeric($value)) {
                $errors[$column] = 'Vlera duhet te jete numer.';
            }
            if (($field['type'] ?? '') === 'email' && $value !== '' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $errors[$column] = 'Email nuk eshte valide.';
            }
            $data[$column] = $this->castValue($value, $field);
        }

        if ($entity === 'users') {
            $email = (string) $data['email'];
            if ((new UserRepository())->emailExists($email, $id)) {
                $errors['email'] = 'Ky email ekziston.';
            }
            if ($data['fjalekalimi'] === '' && $id) {
                unset($data['fjalekalimi']);
            } elseif (strlen((string) $data['fjalekalimi']) < 8) {
                $errors['fjalekalimi'] = 'Minimumi eshte 8 karaktere.';
            } else {
                $data['fjalekalimi'] = password_hash((string) $data['fjalekalimi'], PASSWORD_DEFAULT);
            }
            $data['role'] = $data['role'] === 'Administrator' ? 'Administrator' : 'Perdorues';
        }

        if ($entity === 'products') {
            $data['slug'] = slugify((string) $data['emri'] . '-' . (string) $data['modeli']);
            $data['image'] = $data['image'] ?: 'img/o0.jpg';
        }

        if ($entity === 'offers' && ($data['DataFillimit'] ?? '') >= ($data['DataSkadimit'] ?? '')) {
            $errors['DataSkadimit'] = 'Data e skadimit duhet te jete pas fillimit.';
        }

        if ($errors) {
            $this->form($entity, $id, $errors, $_POST);
            return;
        }

        try {
            if ($id) {
                $this->repository->update($config['table'], $config['primary_key'], $id, $data);
            } else {
                $this->repository->create($config['table'], $data);
            }
            flash('success', $config['singular'] . ($id ? ' u modifikua.' : ' u shtua.'));
            redirect('admin/' . $entity);
        } catch (mysqli_sql_exception $exception) {
            $errors['general'] = 'Te dhenat nuk mund te ruhen. Kontrollo vlerat unike dhe provo perseri.';
            $this->form($entity, $id, $errors, $_POST);
        }
    }

    public function delete(string $entity, int $id): void
    {
        require_admin();
        verify_form_csrf();
        $config = $this->config($entity);
        if ($entity === 'users' && $id === (int) (current_user()['id'] ?? 0)) {
            flash('error', 'Nuk mund ta fshish llogarine ku je kycur.');
            redirect('admin/users');
        }

        try {
            $this->repository->delete($config['table'], $config['primary_key'], $id);
            flash('success', $config['singular'] . ' u fshi.');
        } catch (mysqli_sql_exception $exception) {
            flash('error', 'Regjistrimi perdoret diku tjeter dhe nuk mund te fshihet.');
        }
        redirect('admin/' . $entity);
    }

    public function hasEntity(string $entity): bool
    {
        return isset($this->entities[$entity]);
    }

    private function config(string $entity): array
    {
        if (!$this->hasEntity($entity)) {
            http_response_code(404);
            exit('Moduli admin nuk u gjet.');
        }
        return $this->entities[$entity];
    }

    private function castValue(string $value, array $field): mixed
    {
        return match ($field['cast'] ?? 'string') {
            'int' => (int) $value,
            'float' => (float) $value,
            'nullable_int' => $value === '' ? null : (int) $value,
            default => $value,
        };
    }

    private function dynamicOptions(array $config): array
    {
        $options = [];
        foreach ($config['fields'] as $column => $field) {
            if (!empty($field['source'])) {
                $source = $field['source'];
                $options[$column] = $this->repository->selectOptions(
                    $source['table'],
                    $source['value'],
                    $source['label']
                );
            }
        }
        return $options;
    }

    private function shared(array $data): array
    {
        return array_merge([
            'cartCount' => (new CartService())->count(),
            'favoriteIds' => (new FavoriteService())->ids(),
            'favoriteCount' => (new FavoriteService())->count(),
        ], $data);
    }

    private function entityConfiguration(): array
    {
        return [
            'products' => [
                'label' => 'Produktet',
                'singular' => 'Produkti',
                'table' => 'orat',
                'primary_key' => 'id',
                'list' => ['image' => 'Foto', 'emri' => 'Emri', 'brand' => 'Brendi', 'modeli' => 'Modeli', 'cmimi' => 'Cmimi', 'stock' => 'Stoku', 'discount_percent' => 'Zbritja'],
                'fields' => [
                    'emri' => ['label' => 'Emri i produktit', 'required' => true],
                    'modeli' => ['label' => 'Modeli / referenca', 'required' => true],
                    'brand' => ['label' => 'Brendi', 'required' => true],
                    'cmimi' => ['label' => 'Cmimi', 'type' => 'number', 'step' => '0.01', 'cast' => 'float', 'required' => true],
                    'discount_percent' => ['label' => 'Zbritja %', 'type' => 'number', 'step' => '0.01', 'cast' => 'float'],
                    'stock' => ['label' => 'Stoku', 'type' => 'number', 'cast' => 'int', 'required' => true],
                    'popularity' => ['label' => 'Popullariteti 0-100', 'type' => 'number', 'cast' => 'int'],
                    'is_new' => ['label' => 'New in', 'type' => 'select', 'cast' => 'int', 'options' => [1 => 'Po', 0 => 'Jo']],
                    'movement' => ['label' => 'Mekanizmi'],
                    'material' => ['label' => 'Materiali'],
                    'water_resistance' => ['label' => 'Rezistenca ne uje'],
                    'image' => ['label' => 'Rruga e imazhit', 'placeholder' => 'img/o34.jpg'],
                    'category_id' => ['label' => 'Kategoria', 'type' => 'select', 'cast' => 'nullable_int', 'source' => ['table' => 'kategorite', 'value' => 'kategoriaid', 'label' => 'emri']],
                    'offer_id' => ['label' => 'Oferta', 'type' => 'select', 'cast' => 'nullable_int', 'source' => ['table' => 'ofertat', 'value' => 'OfertaID', 'label' => 'EmriOfertes']],
                    'pershkrimi' => ['label' => 'Pershkrimi', 'type' => 'textarea', 'required' => true],
                    'historia' => ['label' => 'Historia', 'type' => 'textarea'],
                ],
            ],
            'users' => [
                'label' => 'Perdoruesit',
                'singular' => 'Perdoruesi',
                'table' => 'perdoruesit',
                'primary_key' => 'perdoruesiid',
                'list' => ['emri' => 'Emri', 'mbiemri' => 'Mbiemri', 'email' => 'Email', 'telefoni' => 'Telefoni', 'role' => 'Roli', 'last_login_at' => 'Hyrja e fundit'],
                'fields' => [
                    'emri' => ['label' => 'Emri', 'required' => true],
                    'mbiemri' => ['label' => 'Mbiemri', 'required' => true],
                    'email' => ['label' => 'Email', 'type' => 'email', 'required' => true],
                    'telefoni' => ['label' => 'Telefoni'],
                    'nrpersonal' => ['label' => 'Numri personal'],
                    'role' => ['label' => 'Roli', 'type' => 'select', 'options' => ['Perdorues' => 'Perdorues', 'Administrator' => 'Administrator'], 'required' => true],
                    'fjalekalimi' => ['label' => 'Fjalekalimi', 'type' => 'password', 'required' => true, 'help' => 'Ne editim lere bosh per ta ruajtur password-in aktual.'],
                ],
            ],
            'brands' => [
                'label' => 'Brendet', 'singular' => 'Brendi', 'table' => 'brendet', 'primary_key' => 'brendetid',
                'list' => ['emri' => 'Emri', 'vitthemelimi' => 'Themelimi', 'vendndodhja' => 'Vendndodhja', 'website' => 'Website'],
                'fields' => [
                    'emri' => ['label' => 'Emri', 'required' => true],
                    'vitthemelimi' => ['label' => 'Viti i themelimit', 'type' => 'number', 'cast' => 'int'],
                    'vendndodhja' => ['label' => 'Vendndodhja'],
                    'website' => ['label' => 'Website', 'type' => 'url'],
                ],
            ],
            'categories' => [
                'label' => 'Kategorite', 'singular' => 'Kategoria', 'table' => 'kategorite', 'primary_key' => 'kategoriaid',
                'list' => ['emri' => 'Emri', 'pershkrimi' => 'Pershkrimi', 'kostoja' => 'Kostoja'],
                'fields' => [
                    'emri' => ['label' => 'Emri', 'required' => true],
                    'pershkrimi' => ['label' => 'Pershkrimi', 'type' => 'textarea'],
                    'kostoja' => ['label' => 'Kostoja', 'type' => 'number', 'step' => '0.01', 'cast' => 'float'],
                ],
            ],
            'offers' => [
                'label' => 'Ofertat', 'singular' => 'Oferta', 'table' => 'ofertat', 'primary_key' => 'OfertaID',
                'list' => ['EmriOfertes' => 'Emri', 'Zbritja' => 'Zbritja', 'DataFillimit' => 'Fillimi', 'DataSkadimit' => 'Skadimi'],
                'fields' => [
                    'EmriOfertes' => ['label' => 'Emri', 'required' => true],
                    'Zbritja' => ['label' => 'Zbritja %', 'type' => 'number', 'step' => '0.01', 'cast' => 'float', 'required' => true],
                    'DataFillimit' => ['label' => 'Data e fillimit', 'type' => 'date', 'required' => true],
                    'DataSkadimit' => ['label' => 'Data e skadimit', 'type' => 'date', 'required' => true],
                ],
            ],
        ];
    }
}
