<?php

declare(strict_types=1);

namespace Helpers\Validations;

class NewsValidation
{
    /**
     * @param  array  $fields
     *
     * @return array
     */
    public static function validate(array &$fields): array
    {
        $errors = [];

        foreach ($fields as $key => $item) {
            if (empty($item)) {
                $errors[$key] = "Fill in the field $key";
            }
        }

        if (strlen($fields['title']) < 3 || strlen($fields['title']) > 255) {
            $errors[] = "Title must be at least 3 characters long and".
              "no more then 255!";
        }

        if (
          strlen($fields['description']) < 3 ||
          strlen($fields['description']) > 1000
        ) {
            $errors[] = "Description must be at least 3 characters long".
              "and no more then 1000!";
        }

        foreach ($fields as $key => $item) {
            $fields[$key] = htmlspecialchars($item);
        }

        return $errors;
    }
}