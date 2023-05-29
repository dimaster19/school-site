<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\News;
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

        $title = 'Школа №43 г.Донецк';
        $users = News::factory()->count(3)->create();

        $carousel = $this->getCarousel();
        $news = $this->getLatestNews();

        return view('welcome', compact('carousel', 'news', 'title'));
    }

    public function getCarousel()
    {
        return config('carousel.imgs');
    }

    public function setCarousel(array $imgs)
    {
        config(['carousel.imgs' => $imgs]);
        return true;
    }

    public function addImgToCarousel(string $img)
    {
        $imgs = config('carousel.imgs');
        $imgs[] = $img;
        return true;
    }

    public function delImgFromCarousel (string $img)
    {
        $imgs = config('carousel.imgs');
        $arr = array_diff($imgs, array($img));
        $this->setCarousel($arr);
    }

    public function getLatestNews($count = 5)
    {
        return News::latest('id')->take($count)->get();
    }
}
