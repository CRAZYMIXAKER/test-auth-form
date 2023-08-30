<?php

declare(strict_types=1);

namespace App\Controllers;

use Helpers\Notification;
use Helpers\Request;
use Helpers\Response;
use Helpers\Session;
use Helpers\Validations\LoginValidation;

class AuthController
{
    /**
     * @return array
     */
    public function showLoginForm(): array
    {
        return ['path' => 'Login'];
    }

    /**
     * @param  \Helpers\Request  $request
     *
     * @return array
     */
    public function login(Request $request): array
    {
        $user = $request->get('post');
        $errors = LoginValidation::validate($user);

        if ($errors) {
            Notification::setNotifications($errors);
            Response::redirect('/login');
        }

        $authenticatedUser = LoginValidation::authenticate($user);

        if ($authenticatedUser) {
            Session::set('user', $authenticatedUser);

            return (new NewsController())->index();
        }

        Notification::setNotifications(['Wrong login data']);
        Response::redirect('/login');
    }

    /**
     * @return void
     */
    public function logout(): void
    {
        Session::destroy();
    }
}