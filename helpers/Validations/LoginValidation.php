<?php

declare(strict_types=1);

namespace Helpers\Validations;

use App\Models\User;

class LoginValidation
{
    /**
     * @param  array  $fields
     *
     * @return array
     */
    public static function validate(array &$fields): array
    {
        $errors = [];

        foreach ($fields as $key => $item) {
            if (empty($item)) {
                $errors[$key] = "Fill in the field $key";
            }
        }

        if (strlen($fields['name']) < 4 || strlen($fields['name']) > 32) {
            $errors[] = "Name must be at least 4 characters long and".
              "no more then 32!";
        }

        if (
          strlen($fields['password']) < 4 ||
          strlen($fields['password']) > 64
        ) {
            $errors[] = "Password must be at least 4 characters long".
              "and no more then 64!";
        }

        foreach ($fields as $key => $item) {
            $fields[$key] = htmlspecialchars($item);
        }

        return $errors;
    }

    /**
     * @param  array  $user
     *
     * @return false|array
     */
    public static function authenticate(array $user): false|array
    {
        $userByName = User::getByName($user['name']);

        if (!$userByName) {
            return false;
        }

        if ($user['password'] === $userByName['password']) {
            return $userByName;
        }

        return false;
    }
}