<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{

    public function index()
    {
       $news = $this->getPagination(10);
       return view('newspage', compact('news'));
    }

    public function getLatest(int $count)
    {
       return News::latest()->take($count)->get();
    }

    public function getPagination(int $count)
    {
       return News::orderBy('id', 'desc')->paginate(10);
    }

    public function getNews(int $count)
    {
       return News::orderBy('id', 'desc')->paginate(10);
    }

}
