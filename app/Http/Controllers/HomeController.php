<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Notify;
use Illuminate\Support\Facades\DB;

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
        $notify = $this->getNotify();
        $carousel = $this->getCarousel();
        $news = $this->getLatestNews();
        return view('welcome', compact('carousel', 'news', 'notify', 'title'));
    }

    public function getCarousel()
    {
      //  return array_diff(scandir(public_path('build/imgs/carousel')), array('.', '..'));
        return  DB::table('attachments')->where('group', 'carousel')->get();
    }

    public static function setCarousel(array $imgs)
    {
        config(['carousel.imgs' => $imgs]);
        return true;
    }

    public static function addImgToCarousel(string $img)
    {
        $imgs = config('carousel.imgs');
        $imgs[] = $img;
        return true;
    }

    public static function delImgFromCarousel(string $img)
    {
        $imgs = config('carousel.imgs');
        $arr = array_diff($imgs, array($img));
        $t = new self();
        $t->setCarousel($arr);
    }

    public function getLatestNews($count = 5)
    {
        return News::latest('id')->take($count)->get();
    }

    public function getNotify()
    {
        return Notify::latest()->first();
    }

    public function setNotify(string $text)
    {
        Notify::create([
            'text' => $text,
        ]);
        return true;
    }
}
