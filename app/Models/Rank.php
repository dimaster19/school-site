<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;

class Rank extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    protected $allowedSorts = ['id', 'rank_name', 'created_at', 'updated_at'];
    protected $allowedFilters = [
        'id'          => Where::class,
        'rank_name'        => Like::class,
    ];

    protected $guarded = [];
    public $timestamps = true;

}
