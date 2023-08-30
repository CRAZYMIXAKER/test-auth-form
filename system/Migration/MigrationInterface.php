<?php

namespace System\Migration;

interface MigrationInterface
{
    /**
     * @return void
     */
    public function up(): void;

    /**
     * @return bool
     */
    public function down(): bool;
}