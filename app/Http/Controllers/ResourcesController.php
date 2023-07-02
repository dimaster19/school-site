<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resource;

class ResourcesController extends Controller
{

    public function index()
    {
        $resources = $this->getResources();
        $title = 'Ресурсы преподавателей Школы №43 г.Донецк';
        return view('distance', compact('resources', 'title'));
    }

    public function getResources()
    {
        return Resource::all()->groupBy('employee_id');
    }
}
