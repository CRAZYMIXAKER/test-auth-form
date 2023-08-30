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
        static::$db->createTable("migrations", [
          "`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY",
          "`migration` varchar(255) NOT NULL",
          "`batch` int NOT NULL",
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): bool
    {
        return static::$db->dropTable("migrations");
    }

};