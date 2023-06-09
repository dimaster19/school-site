<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{

    public function index()
    {
       $news = $this->getPagination(10);
       $title = 'Новости МБОУ Школа №43 г.Донецк';
       return view('newspage', compact('news', 'title'));
    }

    public function getLatest(int $count)
    {
       return News::latest()->take($count)->get();
    }

    public function getPagination(int $count)
    {
       return News::orderBy('id', 'desc')->paginate(10);
    }

    public function getNews($news)
    {
        $id = null;
        // get id from url
        foreach (str_split($news) as $char) {
            if ($char == '-') break;
            else $id = $id.strval($char);
        }
        // ----

        // get title from url
        $temp = (string)$id.'-';
        $title = str_replace($temp, "", $news);
        $title = str_replace("-", " ", $title);
        // ----

        $news = News::findOrFail($id);
        $news->load('attachment');
        return view('news', compact('news', 'title'));
    }

}
