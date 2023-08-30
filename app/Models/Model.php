<?php

declare(strict_types=1);

namespace App\Models;

use Helpers\Helper;
use System\Database\DatabaseInterface;

class Model
{
    protected static DatabaseInterface $db;

    protected static string $table;

    protected static array $fillable;

    /**
     * @param  DatabaseInterface  $database
     *
     * @return void
     */
    public static function setDb(DatabaseInterface $database): void
    {
        static::$db = $database;
    }

    /**
     * @param  array  $fields
     *
     * @return array|null
     */
    public static function get(array $fields = ['*']): ?array
    {
        $query = sprintf(
          'SELECT %s FROM %s',
          Helper::getSeparatedArrayByComma($fields),
          static::$table
        );
        $result = static::$db->query($query)->fetchAll();

        return $result === false ? null : $result;
    }

    /**
     * @param  int  $currencyId
     * @param  array  $fields
     *
     * @return array|null
     */
    public static function find(int $currencyId, array $fields = ['*']): ?array
    {
        $query = sprintf(
          'SELECT %s FROM %s where id = :id',
          Helper::getSeparatedArrayByComma($fields),
          static::$table
        );
        $result = static::$db->query($query, ['id' => $currencyId])->fetch();

        return $result === false ? null : $result;
    }

    /**
     * @param  array  $params
     *
     * @return mixed
     */
    public static function create(array $params): mixed
    {
        $sql = sprintf(
          'INSERT INTO %s (%s) VALUES (%s)',
          static::$table,
          Helper::getSeparatedArrayByComma(static::$fillable),
          Helper::getSeparatedArrayByColonAndComma(static::$fillable)
        );

        return static::$db->query($sql, $params)->fetch();
    }

    /**
     * @param  int  $id
     *
     * @return mixed
     */
    public static function delete(int $id): mixed
    {
        $sql = "DELETE FROM ".static::$table." WHERE id = :id";

        return static::$db->query($sql, ['id' => $id]);
    }

    /**
     * @param  array  $params
     *
     * @return mixed
     */
    public static function update(array $params): mixed
    {
        $sql = sprintf(
          'UPDATE %s SET %s WHERE id = :id',
          static::$table,
          Helper::getSeparatedArrayByComma(
            array_map(static fn($column) => "$column = :$column",
              static::$fillable)
          )
        );

        return static::$db->query($sql, $params);
    }
}