<?php

namespace App\Models;

class News extends Model
{
    protected static string $table = "news";
    protected static array $fillable = ['title', 'description', 'user_id'];
}