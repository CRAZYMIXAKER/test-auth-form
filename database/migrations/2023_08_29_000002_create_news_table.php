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
        static::$db->createTable("news", [
          "`id` int NOT NULL AUTO_INCREMENT PRIMARY KEY",
          "`user_id` int NOT NULL",
          "`title` varchar(255) NOT NULL",
          "`description` text NOT NULL",
          "FOREIGN KEY(`user_id`) REFERENCES users(`id`) ON DELETE CASCADE",
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): bool
    {
        return static::$db->dropTable("news");
    }
};