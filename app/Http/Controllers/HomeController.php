<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Rank;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        Rank::factory()->count(5)->create();
        Employee::factory()->count(5)->create(); // Удалить
        $title = 'Школа №43 г.Донецк';
        $carousel = '';
        return view('welcome', compact('carousel', 'title'));
    }
}
