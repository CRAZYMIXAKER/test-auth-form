<?php

declare(strict_types=1);

namespace Helpers;

class Notification
{
    /**
     * @param  array  $messages
     * @param  string  $type
     *
     * @return void
     */
    public static function setNotifications(
      array $messages,
      string $type = 'error'
    ): void {
        setcookie(
          'notifications',
          json_encode(['messages' => $messages, 'type' => $type]),
          time() + 10,
          "/"
        );
    }
}