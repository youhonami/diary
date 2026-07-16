<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'diary_date',
        'place',
        'event',
        'good_thing',
        'visibility',
    ];

    protected function casts(): array
    {
        return [
            'diary_date' => 'date',
        ];
    }
}
