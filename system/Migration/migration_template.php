<?php

use System\Migration\Migration;
use System\Migration\MigrationInterface;

return new class extends Migration implements MigrationInterface {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        static::$db->createTable('{{table_name}}', [
          "`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY",
          "`name` varchar(255) NOT NULL",
          "`status` int NOT NULL",
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): bool
    {
        return static::$db->dropTable('{{table_name}}');
    }
};