<?php

declare(strict_types=1);

namespace App\Models;

use Helpers\Helper;
use Helpers\Session;

class User extends Model
{
    protected static string $table = "users";

    protected static array $fillable = ['name', 'password'];

    /**
     * @param  string  $name
     * @param  array  $fields
     *
     * @return array|null
     */
    public static function getByName(
      string $name,
      array $fields = ['*']
    ): ?array {
        $query = sprintf(
          'SELECT %s FROM %s where name = :name',
          Helper::getSeparatedArrayByComma($fields),
          self::$table
        );
        $user = static::$db->query($query, ['name' => $name])->fetch();

        return $user === false ? null : $user;
    }

    /**
     * @return bool
     */
    public static function isLoggedIn(): bool
    {
        return Session::get('user') !== null;
    }
}