<?php
// 1. Настройка CORS
// Мы разрешаем фронтенду (sopo) обращаться к этому API (api)
header("Access-Control-Allow-Origin: https://sopo.abracadabratp.xyz");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");

// 2. Обязательный ответ на Preflight-запрос от браузера
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("HTTP/1.1 200 OK");
    exit;
}

// 3. Загрузка окружения и библиотек
require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// 4. Роутинг (обработка GraphQL)
$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    // ВАЖНО: убедись, что путь совпадает с тем, что шлет фронтенд
    $r->post('/graphql', [App\Controller\GraphQL::class, 'handle']);
});

$routeInfo = $dispatcher->dispatch(
    $_SERVER['REQUEST_METHOD'],
    $_SERVER['REQUEST_URI']
);

// 5. Выдача результата
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        header("HTTP/1.1 404 Not Found");
        echo json_encode(['error' => 'Not Found']);
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        header("HTTP/1.1 405 Method Not Allowed");
        echo json_encode(['error' => 'Method Not Allowed']);
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        // Если хендлер возвращает данные, выводим их
        echo $handler($vars);
        break;
}