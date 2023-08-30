<?php

declare(strict_types=1);

namespace Helpers;

class Helper
{
    /**
     * @param  array  $array
     *
     * @return string
     */
    public static function getSeparatedArrayByComma(array $array): string
    {
        return implode(', ', $array);
    }

    /**
     * @param  array  $array
     *
     * @return string
     */
    public static function getSeparatedArrayByColonAndComma(array $array
    ): string {
        return self::getSeparatedArrayByComma(
          array_map(static fn($column) => ":$column", $array)
        );
    }

    /**
     * Get links for the navigation bar template
     *
     * @return array
     */
    public static function getNavigationLinks(): array
    {
        return [
          'uri' => $_SERVER['REQUEST_URI'],
        ];
    }
}