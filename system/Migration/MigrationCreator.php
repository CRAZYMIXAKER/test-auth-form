<?php

namespace System\Migration;

use DateTime;

class MigrationCreator extends Migration
{
    /**
     * @param  string  $migrationName
     *
     * @return array|false|string
     */
    private static function generateMigrationFile(string $migrationName
    ): array|false|string {
        $tableName = self::getMigrationTableName($migrationName);
        $migrationTemplate = file_get_contents(
          __CORE__.'system/Migration/migration_template.php'
        );

        return str_replace(
          '{{table_name}}',
          $tableName,
          $migrationTemplate
        );
    }

    /**
     * @param $migrationName
     *
     * @return string
     */
    private static function getMigrationTableName($migrationName): string
    {
        $pattern = '/([^_]+)_table/';

        preg_match($pattern, $migrationName, $matches);

        return $matches[1];
    }

    /**
     * @param $dateTime
     * @param $migrationName
     *
     * @return string
     */
    private static function generateMigrationFileName(
      $dateTime,
      $migrationName
    ): string {
        return __CORE__.static::MIGRATIONS_PATH.
          "{$dateTime->format('Y_m_d_Gis')}_{$migrationName}.php";
    }

    /**
     * @return void
     */
    public static function createMigrationFile(): void
    {
        try {
            $dateTime = new DateTime('now');
            $migrationName = $_SERVER['argv'][2];
            $fileName = self::generateMigrationFileName(
              $dateTime,
              $migrationName
            );
            $fileContent = self::generateMigrationFile($migrationName);

            file_put_contents($fileName, $fileContent);

            echo "\e[33mMigration created!\e[39m".PHP_EOL;
            exit();
        } catch (\Exception $e) {
            echo "\e[31mError creating migration: {$e->getMessage()}\e[39m".PHP_EOL;
        }
    }
}