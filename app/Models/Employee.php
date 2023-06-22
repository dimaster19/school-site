<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = true;


    public function resource()
    {
        return $this->hasMany(Resource::class);
    }
}
