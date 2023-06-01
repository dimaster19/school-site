<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $title = 'Админ-панель';
        $tables = ['news', 'ranks', 'employees'];
        return view('admin-panel', compact('title', 'tables'));
    }

}
