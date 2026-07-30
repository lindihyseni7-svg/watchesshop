<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Services\AuthService;
use App\Services\CartService;
use App\Services\FavoriteService;

// Serves guest authentication pages and processes login/registration actions.
final class AuthController
{
    public function __construct(private readonly AuthService $auth = new AuthService())
    {
    }

    public function loginForm(): void
    {
        require_guest();
        render('auth/login', $this->viewData('Kycu | Watches Prishtina'));
    }

    public function login(): void
    {
        require_guest();
        verify_form_csrf();
        if ($this->auth->attempt($_POST['email'] ?? '', $_POST['password'] ?? '')) {
            flash('success', 'Mire se erdhe perseri.');
            redirect(is_admin() ? 'admin' : '');
        }
        render('auth/login', $this->viewData('Kycu | Watches Prishtina', [
            'error' => 'Email ose fjalekalim i pasakte.',
            'old' => ['email' => $_POST['email'] ?? ''],
        ]));
    }

    public function registerForm(): void
    {
        require_guest();
        render('auth/register', $this->viewData('Regjistrohu | Watches Prishtina'));
    }

    public function register(): void
    {
        require_guest();
        verify_form_csrf();
        $data = [
            'first_name' => trim($_POST['first_name'] ?? ''),
            'last_name' => trim($_POST['last_name'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'phone' => trim($_POST['phone'] ?? ''),
            'personal_number' => trim($_POST['personal_number'] ?? ''),
            'password' => $_POST['password'] ?? '',
            'password_confirmation' => $_POST['password_confirmation'] ?? '',
        ];
        $errors = $this->auth->register($data);
        if ($errors) {
            render('auth/register', $this->viewData('Regjistrohu | Watches Prishtina', [
                'errors' => $errors,
                'old' => $data,
            ]));
            return;
        }
        flash('success', 'Llogaria u krijua. Tani mund te kycesh.');
        redirect('login');
    }

    public function logout(): void
    {
        require_auth();
        verify_form_csrf();
        $this->auth->logout();
        flash('success', 'U ckyce me sukses.');
        redirect('');
    }

    private function viewData(string $title, array $data = []): array
    {
        return array_merge([
            'title' => $title,
            'cartCount' => (new CartService())->count(),
            'favoriteIds' => (new FavoriteService())->ids(),
            'favoriteCount' => (new FavoriteService())->count(),
        ], $data);
    }
}
