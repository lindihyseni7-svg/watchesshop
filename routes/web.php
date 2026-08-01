<?php
declare(strict_types=1);

// Public storefront and authentication route definitions.
use App\Controllers\AuthController;
use App\Controllers\StoreController;
use App\Content\BlogCatalog;
use App\Repositories\CommunicationRepository;

$store = new StoreController();
$auth = new AuthController();

$routes = [
    'GET /' => fn () => $store->home(),
    'GET /home' => fn () => $store->home(),
    'GET /shop' => fn () => $store->shop(),
    'GET /favorites' => fn () => $store->favorites(),
    'GET /cart' => fn () => $store->cart(),
    'GET /about' => fn () => $store->static('about', 'Rreth nesh | Watches Prishtina'),
    'GET /contact' => fn () => $store->static('contact', 'Kontakt | Watches Prishtina'),
    'POST /contact' => function () use ($store): void {
        verify_form_csrf();
        $name = trim((string) ($_POST['name'] ?? ''));
        $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
        $subject = trim((string) ($_POST['subject'] ?? ''));
        $message = trim((string) ($_POST['message'] ?? ''));
        if ($name === '' || !$email || $subject === '' || strlen($message) < 10) {
            flash('error', 'Ploteso te gjitha fushat me te dhena valide.');
            redirect('contact');
        }
        (new CommunicationRepository())->saveMessage($name, $email, $subject, $message);
        flash('success', 'Mesazhi u dergua. Do te kontaktojme se shpejti.');
        redirect('contact');
    },
    'GET /faq' => fn () => $store->static('faq', 'Pyetje te shpeshta | Watches Prishtina'),
    'GET /blog' => fn () => $store->blog(),
    'GET /sell-watch' => fn () => $store->static('sell-watch', 'Shit oren tende | Watches Prishtina'),
    'GET /login' => fn () => $auth->loginForm(),
    'POST /login' => fn () => $auth->login(),
    'GET /register' => fn () => $auth->registerForm(),
    'POST /register' => fn () => $auth->register(),
    'POST /newsletter' => function (): void {
        verify_form_csrf();
        $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
        if (!$email) {
            flash('error', 'Shkruaj nje email valide.');
            redirect('');
        }
        (new CommunicationRepository())->subscribe($email);
        flash('success', 'U regjistrove per lajmet tona.');
        redirect('');
    },
    'POST /logout' => fn () => $auth->logout(),
];

foreach (BlogCatalog::all() as $post) {
    $slug = $post['slug'];
    $routes['GET /blog/' . $slug] = fn () => $store->blogPost($slug);
}

return $routes;
