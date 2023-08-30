<?php

declare(strict_types=1);

namespace Helpers;

use JsonException;

class Response
{
    /**
     * @param  int  $codeError
     *
     * @return array
     */
    public function showError(int $codeError): array
    {
        http_response_code($codeError);
        $navigationLinks = Helper::getNavigationLinks();

        return [
          'path' => 'Error',
          'codeError' => $codeError,
          'links' => $navigationLinks,
        ];
    }

    /**
     * @param $route
     *
     * @return void
     */
    public static function redirect($route): void
    {
        header("Location: $route");
        exit();
    }

    /**
     * @param $result
     *
     * @return void
     * @throws JsonException
     */
    public function json($result): void
    {
        echo json_encode($result, JSON_THROW_ON_ERROR);
        header('Content-Type: application/json');
        return;
    }
}