<?php

namespace System\Migration;

class MigrationRollback extends Migration
{
    /**
     * @return void
     */
    public static function rollback(): void
    {
        $maxMigrationBatch = MigrationTableManager::getMaxMigrationBatch();

        $rollbackMigrationQuery = "SELECT * FROM migrations WHERE batch = :batch AND batch > 1";
        $rollbackMigrations = static::$db->query($rollbackMigrationQuery, [
          "batch" => $maxMigrationBatch,
        ])->fetchAll();

        if (!empty($rollbackMigrations)) {
            foreach ($rollbackMigrations as $rollbackMigration) {
                $migrationFile = include __CORE__.static::MIGRATIONS_PATH.$rollbackMigration['migration'];
                $migrationDownResult = $migrationFile->down();

                if ($migrationDownResult) {
                    static::$db->query(
                      'DELETE FROM migrations WHERE migration=:migration AND batch=:batch',
                      [
                        'migration' => $rollbackMigration['migration'],
                        'batch' => $maxMigrationBatch,
                      ]
                    );

                    echo "\e[32mRollback: {$rollbackMigration['migration']}\e[39m".PHP_EOL;
                    continue;
                }

                echo "\e[31mNo Rollback: {$rollbackMigration['migration']}\e[39m".PHP_EOL;
            }
            exit();
        }
        echo "\e[33mNothing to rollback!\e[39m".PHP_EOL;
    }
}