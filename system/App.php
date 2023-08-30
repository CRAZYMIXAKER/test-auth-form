<?php

namespace System;

use App\Controllers\AuthController;
use App\Controllers\NewsController;
use App\Models\User;
use Helpers\Request;
use Helpers\Response;
use JsonException;
use System\Database\DatabaseInterface;
use System\Database\PDODriver;

class App
{
    /**
     * @param  string  $uri
     * @param  array  $routes
     *
     * @return array|null
     */
    protected function matchRoute(string $uri, array $routes): ?array
    {
        foreach ($routes as $route) {
            if (
              $_SERVER['REQUEST_METHOD'] === $route['request_method'] &&
              preg_match($route['route'], $uri)
            ) {
                return $route;
            }
        }
        return null;
    }

    /**
     * @param  string  $uri
     * @param  array  $routes
     *
     * @return bool|array
     * @throws JsonException
     */
    public function run(string $uri, array $routes): bool|array
    {
        $checkRoute = $this->checkRoute($uri, $routes);

        if (!$checkRoute) {
            return (new Response())->showError(404);
        }

        return $checkRoute;
    }

    /**
     * @param  string  $uri
     * @param  array  $routes
     *
     * @return bool|array
     * @throws JsonException
     */
    private function checkRoute(string $uri, array $routes): bool|array
    {
        $route = $this->matchRoute($uri, $routes);

        if ($route === null) {
            return false;
        }

        $request = new Request($_SERVER['REQUEST_URI']);

        if (
          !User::isLoggedIn() &&
          $route['request_method'] !== 'POST'
        ) {
            return (new AuthController())->showLoginForm();
        }

        if (
          User::isLoggedIn() &&
          $route['controller'] === 'Auth' &&
          $route['method'] !== 'logout'
        ) {
            return (new NewsController())->index();
        }

        $method = $route['method'];
        $controller = "\\App\\Controllers\\{$route['controller']}Controller";

        return empty($request->get()) ?
          (new $controller())->$method() :
          (new $controller())->$method($request);
    }

    /**
     * @param  string  $databaseName
     *
     * @return DatabaseInterface
     */
    public static function chooseDatabaseConnection(string $databaseName
    ): DatabaseInterface {
        return match ($databaseName) {
            'mysql' => PDODriver::getInstance(),
            default => PDODriver::getInstance(),
        };
    }
}