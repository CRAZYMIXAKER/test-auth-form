<?php

use System\Migration\Migration;
use System\Migration\MigrationInterface;

return new class extends Migration implements MigrationInterface {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        static::$db->createTable("users", [
          "`id` int NOT NULL AUTO_INCREMENT PRIMARY KEY",
          "`name` varchar(32) NOT NULL",
          "`password` varchar(64) NOT NULL",
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): bool
    {
        return static::$db->dropTable("users");
    }
};