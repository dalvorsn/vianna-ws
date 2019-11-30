<?php
declare(strict_types=1);

use App\Application\Middleware\SessionMiddleware;
use App\Application\Middleware\Auth;
use Slim\Middleware\TokenAuthentication;
use Slim\App;

return function (App $app) {
  $app->add(SessionMiddleware::class);

  $app->add(new Tuupola\Middleware\JwtAuthentication([
      "path" => "/.+",
      "ignore" => ["/token"],
      "secure" => false,
      "secret" =>  $_ENV["JWT_SECRET"] ?? 'secret'
  ]));
};
