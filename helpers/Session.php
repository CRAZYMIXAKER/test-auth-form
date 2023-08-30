<?php

declare(strict_types=1);

namespace Helpers;

class Session
{
    /**
     * @return void
     */
    public static function start(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    /**
     * @param  string  $key
     * @param  mixed  $value
     *
     * @return void
     */
    public static function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * @param  string  $key
     *
     * @return array|null
     */
    public static function get(string $key): ?array
    {
        return $_SESSION[$key] ?? null;
    }

    /**
     * @return mixed
     */
    public static function getUser(): mixed
    {
        return $_SESSION['user'] ?? null;
    }

    /**
     * @return void
     */
    public static function destroy(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_unset();
            session_destroy();
        }
    }
}