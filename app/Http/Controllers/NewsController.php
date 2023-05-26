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

    public function getNews($name)
    {
        $id = null;
        // get id from url
        foreach (str_split($name) as $char) {
            if ($char == '-') break;
            else $id = $id.strval($char);
        }

        // get title from url
        $temp = (string)$id.'-';
        $title = str_replace($temp, "", $name);
        $title = str_replace("-", " ", $title);
        // --

        $news= News::findOrFail($id);
        return view('news', compact('news', 'title'));
    }

}
