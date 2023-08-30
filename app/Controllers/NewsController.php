<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\News;
use App\Services\NewsService;
use Helpers\Request;
use Helpers\Response;

class NewsController
{
    /**
     * @return array
     */
    public function index(): array
    {
        $news = News::get();

        return [
          'path' => 'News/Index',
          'news' => $news,
        ];
    }

    /**
     * @param  \Helpers\Request  $request
     *
     * @return void
     */
    public function store(Request $request): void
    {
        NewsService::createNews($request->get('post'));
        Response::redirect('/news');
    }

    /**
     * @param  \Helpers\Request  $request
     *
     * @return void
     */
    public function destroy(Request $request): void
    {
        NewsService::deleteNews((int)$request->get('json')['id']);
    }

    /**
     * @param  \Helpers\Request  $request
     *
     * @return void
     */
    public function update(Request $request): void
    {
        NewsService::updateNews($request->get('post'));
        Response::redirect('/news');
    }
}