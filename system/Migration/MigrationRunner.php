<?php

namespace System\Migration;

class MigrationRunner extends Migration
{

    /**
     * @return void
     */
    protected static function runMigrations(): void
    {
        $migrationFiles = array_diff(
          scandir(static::MIGRATIONS_PATH),
          ['..', '.']
        );

        $migrationsQuery = "SELECT * FROM migrations";
        $migrations = static::$db->query($migrationsQuery)->fetchAll();

        $filteredMigrations = array_diff(
          $migrationFiles,
          array_filter($migrationFiles, function ($item) use ($migrations) {
              foreach ($migrations as $migration) {
                  if ($migration['migration'] === $item) {
                      return true;
                  }
              }
          })
        );

        if ($filteredMigrations) {
            $batchMaxNumber = MigrationTableManager::getMaxMigrationBatch() + 1;

            foreach ($filteredMigrations as $migration) {
                $migrationClass = include __CORE__.
                  static::MIGRATIONS_PATH.$migration;

                $migrationClass->up();

                MigrationTableManager::addMigration(
                  $migration,
                  $batchMaxNumber
                );
            }
        } else {
            echo "\e[33mNothing to migrate!\e[39m".PHP_EOL;
        }
    }

    /**
     * @param  bool|string  $type
     *
     * @return void
     */
    public static function run(bool|string $type = ''): void
    {
        $migrationTableQuery = "SHOW TABLES LIKE 'migrations'";
        $checkMigrationTable = static::$db->query($migrationTableQuery)->fetch();

        if (!$checkMigrationTable) {
            MigrationTableManager::createMigrationTable();
        }

        if ($type === ":make") {
            MigrationCreator::createMigrationFile();
        }

        if ($type === ":fresh") {
            $clearMigrationsTableQuery = "DELETE FROM migrations WHERE batch > 1";
            static::$db->query($clearMigrationsTableQuery);
            static::runMigrations();
            echo "\e[33mEvery migration was ran\e[39m".PHP_EOL;
            exit();
        }

        if ($type === ':rollback') {
            MigrationRollback::rollback();
        }

        if ($type !== ':rollback' && $type !== ':fresh' && $type !== false) {
            $migrationFileName = "{$type}.php";
            $migrationFile = static::MIGRATIONS_PATH.$migrationFileName;

            $sql = "SELECT * FROM migrations WHERE migration=:migration";
            $checkMigrationTable = static::$db->query(
              $sql,
              ['migration' => $migrationFileName]
            )->fetch();

            if (!$checkMigrationTable && is_readable($migrationFile)) {
                $migration = include __CORE__.$migrationFile;
                $migration->up();

                MigrationTableManager::addMigration(
                  $migrationFileName,
                  MigrationTableManager::getMaxMigrationBatch() + 1
                );

                exit();
            }

            echo "\e[33mMigration file doesn't issue or you did migrate for 
            this file before!\e[39m".PHP_EOL;
        }

        if (!$type) {
            static::runMigrations();
        }
    }

}