<?php
declare(strict_types=1);

namespace App\Repositories;

// Product catalog queries, filtering, sorting, pagination and detail retrieval.
use App\Core\Database;
use mysqli;

final class ProductRepository
{
    private mysqli $db;

    public function __construct()
    {
        $this->db = Database::connection();
    }

    public function featured(int $limit = 8): array
    {
        $sql = "SELECT * FROM orat ORDER BY popularity DESC, created_at DESC, id DESC LIMIT ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $limit);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function bestSellers(int $limit = 8): array
    {
        $slugs = [
            'rolex-sea-dweller-black',
            'audemars-piguet-royal-oak-offshore',
            'jacob-co-bugatti-chiron',
            'rolex-daytona-oysterflex',
            'diesel-red-iridescent',
            'bulova-curv-chronograph-blue',
            'philipp-plein-hexagon-phantom',
            'gucci-g-timeless-blue',
        ];
        $selectedSlugs = array_slice($slugs, 0, max(1, $limit));
        $placeholders = implode(',', array_fill(0, count($selectedSlugs), '?'));
        $orderSlugs = implode(',', array_map(
            fn (string $slug): string => "'" . $this->db->real_escape_string($slug) . "'",
            $selectedSlugs
        ));
        $types = str_repeat('s', count($selectedSlugs));

        $stmt = $this->db->prepare(
            "SELECT * FROM orat WHERE slug IN ({$placeholders}) ORDER BY FIELD(slug, {$orderSlugs})"
        );
        $stmt->bind_param($types, ...$selectedSlugs);
        $stmt->execute();
        $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        if (count($products) >= $limit) {
            return array_slice($products, 0, $limit);
        }

        $usedIds = array_map(static fn (array $product): int => (int) $product['id'], $products);
        $remaining = $limit - count($products);
        if (!$usedIds) {
            return $this->featured($limit);
        }

        $idPlaceholders = implode(',', array_fill(0, count($usedIds), '?'));
        $idTypes = str_repeat('i', count($usedIds));
        $fillStmt = $this->db->prepare(
            "SELECT * FROM orat WHERE id NOT IN ({$idPlaceholders}) ORDER BY popularity DESC, created_at DESC, id DESC LIMIT ?"
        );
        $fillParams = [...$usedIds, $remaining];
        $fillStmt->bind_param($idTypes . 'i', ...$fillParams);
        $fillStmt->execute();

        return array_merge($products, $fillStmt->get_result()->fetch_all(MYSQLI_ASSOC));
    }

    public function newest(int $limit = 8): array
    {
        $sql = "SELECT * FROM orat ORDER BY is_new DESC, created_at DESC, id DESC LIMIT ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $limit);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function find(int|string $identifier): ?array
    {
        $field = is_numeric($identifier) ? 'id' : 'slug';
        $stmt = $this->db->prepare("SELECT * FROM orat WHERE {$field} = ? LIMIT 1");
        if ($field === 'id') {
            $id = (int) $identifier;
            $stmt->bind_param('i', $id);
        } else {
            $slug = (string) $identifier;
            $stmt->bind_param('s', $slug);
        }
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc() ?: null;
    }

    public function related(array $product, int $limit = 4): array
    {
        $stmt = $this->db->prepare(
            'SELECT * FROM orat WHERE brand = ? AND id <> ? ORDER BY popularity DESC LIMIT ?'
        );
        $stmt->bind_param('sii', $product['brand'], $product['id'], $limit);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function brands(): array
    {
        $result = $this->db->query(
            "SELECT brand, COUNT(*) AS total FROM orat WHERE brand <> '' GROUP BY brand ORDER BY brand"
        );
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function stats(): array
    {
        $result = $this->db->query(
            'SELECT COUNT(*) AS products, COUNT(DISTINCT brand) AS brands, MIN(cmimi) AS min_price FROM orat'
        );
        return $result->fetch_assoc();
    }

    public function catalog(array $filters): array
    {
        $page = max(1, (int) ($filters['page'] ?? 1));
        $perPage = 12;
        $where = [];
        $params = [];
        $types = '';

        $search = trim((string) ($filters['search'] ?? ''));
        if ($search !== '') {
            $where[] = '(emri LIKE ? OR modeli LIKE ? OR brand LIKE ? OR pershkrimi LIKE ? OR historia LIKE ? OR movement LIKE ? OR material LIKE ? OR water_resistance LIKE ? OR slug LIKE ?)';
            $like = '%' . $search . '%';
            array_push($params, $like, $like, $like, $like, $like, $like, $like, $like, $like);
            $types .= 'sssssssss';
        }

        $brand = trim((string) ($filters['brand'] ?? ''));
        if ($brand !== '') {
            $where[] = 'brand = ?';
            $params[] = $brand;
            $types .= 's';
        }

        if (($filters['min'] ?? '') !== '' && is_numeric($filters['min'])) {
            $where[] = 'cmimi >= ?';
            $params[] = (float) $filters['min'];
            $types .= 'd';
        }

        if (($filters['max'] ?? '') !== '' && is_numeric($filters['max'])) {
            $where[] = 'cmimi <= ?';
            $params[] = (float) $filters['max'];
            $types .= 'd';
        }

        if (!empty($filters['discount'])) {
            $where[] = 'discount_percent > 0';
        }

        if (!empty($filters['in_stock'])) {
            $where[] = 'stock > 0';
        }

        $orders = [
            'newest' => 'is_new DESC, created_at DESC, id DESC',
            'popular' => 'popularity DESC, id DESC',
            'discount_desc' => 'discount_percent DESC, popularity DESC',
            'price_asc' => '(cmimi * (1 - discount_percent / 100)) ASC',
            'price_desc' => '(cmimi * (1 - discount_percent / 100)) DESC',
            'brand_asc' => 'brand ASC, emri ASC',
            'brand_desc' => 'brand DESC, emri DESC',
        ];
        $order = $orders[$filters['sort'] ?? 'newest'] ?? $orders['newest'];
        $whereSql = $where ? ' WHERE ' . implode(' AND ', $where) : '';

        $countStmt = $this->db->prepare('SELECT COUNT(*) AS total FROM orat' . $whereSql);
        if ($params) {
            $countStmt->bind_param($types, ...$params);
        }
        $countStmt->execute();
        $total = (int) $countStmt->get_result()->fetch_assoc()['total'];

        $offset = ($page - 1) * $perPage;
        $dataSql = "SELECT * FROM orat{$whereSql} ORDER BY {$order} LIMIT ? OFFSET ?";
        $dataParams = [...$params, $perPage, $offset];
        $dataTypes = $types . 'ii';
        $stmt = $this->db->prepare($dataSql);
        $stmt->bind_param($dataTypes, ...$dataParams);
        $stmt->execute();

        return [
            'items' => $stmt->get_result()->fetch_all(MYSQLI_ASSOC),
            'total' => $total,
            'page' => $page,
            'pages' => max(1, (int) ceil($total / $perPage)),
        ];
    }

    public function findMany(array $ids): array
    {
        $ids = array_values(array_unique(array_filter(array_map('intval', $ids))));
        if (!$ids) {
            return [];
        }

        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $types = str_repeat('i', count($ids));
        $stmt = $this->db->prepare("SELECT * FROM orat WHERE id IN ({$placeholders})");
        $stmt->bind_param($types, ...$ids);
        $stmt->execute();
        $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        $indexed = [];
        foreach ($products as $product) {
            $indexed[(int) $product['id']] = $product;
        }
        return $indexed;
    }
}
