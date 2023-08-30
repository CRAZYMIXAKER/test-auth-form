<?php

declare(strict_types=1);

session_start();

const __CORE__ = __DIR__.'/../';
require_once __CORE__.'vendor/autoload.php';

use App\Models\Model;
use App\Models\User;
use System\App;
use System\DotEnv;
use System\Twig;

(new DotEnv(__CORE__.'.env'))->load();

// Set the database connection in the main model to work with the database in all models
Model::setDb(App::chooseDatabaseConnection(getenv('DB_CONNECTION')));

$routes = require __CORE__.'system/routes.php';
$result = (new App())->run($_SERVER['REQUEST_URI'], $routes);

echo (new Twig())->makeTemplate($result['path'], $result);



// You can delete it (entire code below), if you want
static $isGenerateUser = false;

if (!$isGenerateUser) {
    generateTestUsers();
}

function generateTestUsers(): void
{
    $users = [
      ['name' => 'root', 'password' => 'root'],
      ['name' => 'user', 'password' => 'user'],
      ['name' => 'admin', 'password' => 'test'],
    ];

    foreach ($users as $user) {
        if (!User::getByName($user['name'])) {
            User::create($user);
        }
    }
}