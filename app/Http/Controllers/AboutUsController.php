<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {
       $news = $this->getPagination(10);
       $title = 'Новости МБОУ Школа №43 г.Донецк';
       return view('newspage', compact('news', 'title'));
    }

    public function getWorkers()
    {

    }
}
