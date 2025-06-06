<?php declare(strict_types=1);

require '../vendor/autoload.php';

use Infra\DED\BoundinaryError;
use Infra\Routing\DispatchRouter;
use Infra\Config\{ Paths, Session };
use Infra\Services\{ Container, Dotenv };

BoundinaryError::register();

Session::init();
Dotenv::load(Paths::ENV_PATH);

$uri = $_SERVER['REQUEST_URI'] ?? '';
$uriParsed = parse_url($uri, PHP_URL_PATH) ?? '';

$endpoint = $uriParsed === '/' ? '' : $uriParsed;
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

BoundinaryError::wrap(function() use ($endpoint, $method) {
  $container = Container::getInstance();
  $dispatcher = $container->get(DispatchRouter::class);
  $dispatcher->dispatch($method, $endpoint);
});