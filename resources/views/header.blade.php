<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{$title}}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @vite(['resources/js/app.js'])


</head>

<body class="antialiased">

    <header>
        <div class="container px-0 border-bottom py-3 fs-5 w-100">
            <div class="row ">
                <div class="col-lg-6 col-md-6 col-sm-12 align-items-center d-flex align-items-center  justify-content-lg-start justify-content-md-start justify-content-sm-center">
                    <a href="{{env('APP_URL')}}" class="d-flex align-items-center link-opacity-25-hover link-dark text-decoration-none">
                        <img src="{{env('APP_URL')}}/build/imgs/logo.png" class="w-auto" style="height: 70px" alt="logo">
                    </a>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 d-flex align-items-center">
                    <ul class="nav w-100 justify-content-lg-end justify-content-md-end justify-content-sm-center">
                        <li class="nav-item d-flex">
                            <div class="d-flex align-items-center"><i class="fa fa-phone px-1" style="font-size: 18px; color:#2e86de" aria-hidden="true"></i></div>
                            <a href="tel:+79494531981" class="nav-link p-0 link-dark link-opacity-25-hover">+7 949 453-19-81</a>
                        </li>
                        <li class="nav-item d-flex">
                            <div class="d-flex align-items-center"><i class="fa fa-map-marker px-1" style="font-size: 18px; color:#2e86de" aria-hidden="true"></i></div>
                            <div class="d-flex align-items-center link-dark link-opacity-25-hover">г.Донецк, ул.Артема, д.192-г, кв.85</div>
                        </li>
                        @auth
                        <li class="nav-item d-flex ms-2">
                            <a href="{{env('APP_URL').'/logout'}}" class="d-flex align-items-center link-dark link-opacity-25-hover">Выход</a>
                        </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>

        <nav class="bg-body-tertiary">
            <div class="container">
                <ul class="nav w-100 d-flex justify-content-center">
                    <li class="nav-item"><a href="{{ env('APP_URL')}}" class="nav-link link-dark link-opacity-25-hover py-2 px-2">Главная</a></li>
                    <li class="nav-item"><a href="{{ env('APP_URL').'/o-nas'}}" class="nav-link link-dark link-opacity-25-hover py-2 px-2">О нас</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link link-dark link-opacity-25-hover px-2 " id="teachprocess">
                            Учебный процесс
                        </a>
                        <ul class="p-0 py-2 drop-link" style="z-index: 1000; width: 150px; overflow-wrap:break-word;">
                            <li><a class="dropdown-item text-wrap" href="{{ env('APP_URL').'/distancionnoe-obuchenie'}}">
                                    Дистанционное образование
                                </a>
                            </li>
                            <li><a class="dropdown-item" href="{{ env('APP_URL').'/raspisanie'}}">Расписание</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a href="{{ env('APP_URL').'/novosti'}}" class="nav-link link-dark link-opacity-25-hover py-2 px-2">Новости</a></li>
                    <li class="nav-item"><a href="{{ env('APP_URL').'/kontakti'}}" class="nav-link link-dark link-opacity-25-hover py-2 px-2">Контакты</a></li>
                </ul>
            </div>
        </nav>
    </header>
