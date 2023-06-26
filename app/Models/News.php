<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;

class News extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;
    use Attachable;

    protected $allowedSorts = ['id', 'title', 'text'];
    protected $allowedFilters = [
        'id'          => Where::class,
        'title'        => Like::class,
        'text'        => Like::class,

    ];
    protected $guarded = [];
    public $timestamps = true;

}
