<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\News;
use Helpers\Notification;
use Helpers\Session;
use Helpers\Validations\NewsValidation;

class NewsService
{
    /**
     * @param  array  $fields
     *
     * @return void
     */
    public static function createNews(array $fields): void
    {
        $news = $fields;
        $errors = NewsValidation::validate($news);

        if ($errors) {
            Notification::setNotifications($errors);
        } else {
            try {
                $news['user_id'] = Session::getUser()['id'];
                News::create($news);
                Notification::setNotifications(
                  ['News was successful created!'],
                  'success'
                );
            } catch (\Exception $e) {
                Notification::setNotifications([$e->getMessage()]);
            }
        }
    }

    /**
     * @param  int  $id
     *
     * @return void
     */
    public static function deleteNews(int $id): void
    {
        try {
            News::delete($id);
            Notification::setNotifications(['News was deleted!'], 'success');
        } catch (\Exception $e) {
            Notification::setNotifications([$e->getMessage()]);
        }
    }

    /**
     * @param  array  $fields
     *
     * @return void
     */
    public static function updateNews(array $fields): void
    {
        $news = $fields;
        $errors = NewsValidation::validate($news);

        if ($errors) {
            Notification::setNotifications($errors);
        } else {
            try {
                $news['user_id'] = Session::getUser()['id'];
                News::update($news);
                Notification::setNotifications(
                  ['News was successful updated!'],
                  'success'
                );
            } catch (\Exception $e) {
                Notification::setNotifications([$e->getMessage()]);
            }
        }
    }
}