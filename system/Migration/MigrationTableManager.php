<?php

namespace System\Migration;

class MigrationTableManager extends Migration
{
    /**
     * @param $migrationFileName
     * @param $batchNumber
     *
     * @return void
     */
    public static function addMigration($migrationFileName, $batchNumber): void
    {
        echo "\e[33mMigrating:  {$migrationFileName} \e[39m".PHP_EOL;

        $addOneMigrationQuery = "INSERT INTO migrations (migration, batch) 
                                 VALUES (:migration, :batch)";

        static::$db->query($addOneMigrationQuery, [
          'migration' => $migrationFileName,
          'batch' => $batchNumber,
        ]);

        echo "\e[32mMigrated:  $migrationFileName \e[39m".PHP_EOL;
    }

    /**
     * @return mixed
     */
    public static function getMaxMigrationBatch(): mixed
    {
        $batchMaxQuery = "SELECT batch FROM migrations ORDER BY batch DESC LIMIT 1";

        return (static::$db->query($batchMaxQuery)->fetch())['batch'];
    }

    /**
     * @return void
     */
    public static function createMigrationTable(): void
    {
        $createMigrationTable = include __CORE__.static::MIGRATIONS_PATH.
          "2023_08_29_000000_create_migrations_table.php";
        $createMigrationTable->up();

        $addMigrationQuery = "INSERT INTO migrations (migration, batch) 
                                  VALUES (:migration, :batch)";

        static::$db->query($addMigrationQuery, [
          'migration' => "2023_08_29_000000_create_migrations_table.php",
          'batch' => 1,
        ]);
    }
}