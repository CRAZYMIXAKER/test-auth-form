<?php

namespace System\Migration;

use DateTime;
use System\Database\DatabaseInterface;

class Migration
{
    protected const MIGRATIONS_PATH = 'database/migrations/';
    protected static DatabaseInterface $db;

    /**
     * @param  DatabaseInterface  $database
     *
     * @return void
     */
    public static function setDb(DatabaseInterface $database): void
    {
        static::$db = $database;
    }
}