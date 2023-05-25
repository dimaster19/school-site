<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @vite(['resources/js/app.js'])


</head>

<body class="antialiased">

    <header>
        <div class="py-3 d-flex justify-content-between px-0  container mx-auto border-bottom ">
            <div class="d-flex px-0 align-items-center">
                <a href="/" class="d-flex align-items-center link-opacity-25-hover link-dark text-decoration-none">
                    <h1 class="fs-4">МБОУ "ШКОЛА № 43 ГОРОДА ДОНЕЦКА"</h1>
                </a>
            </div>
            <div class="d-flex px-0 align-items-center">
                <ul class="nav">
                    <li class="nav-item d-flex" style="margin-right: 10px;">
                        <div class="d-flex align-items-center"><i class="fa fa-phone px-1" style="font-size: 18px;" aria-hidden="true"></i></div>
                        <a href="#" class="nav-link p-0 link-dark link-opacity-25-hover">+7 949 453 19 81</a>
                    </li>
                    <li class="nav-item d-flex">
                        <div class="d-flex align-items-center"><i class="fa fa-map-marker px-1" style="font-size: 18px;" aria-hidden="true"></i></div>
                        <div class="d-flex align-items-center link-dark link-opacity-25-hover">г.Донецк, ул.Артема, д.192-г, кв.85</div>
                    </li>
                </ul>
            </div>
        </div>
        <nav class="bg-body-tertiary">
            <div class="container">
                <ul class="nav w-100 d-flex justify-content-center">
                    <li class="nav-item"><a href="#" class="nav-link link-dark link-opacity-25-hover py-2 px-2">Главная</a></li>
                    <li class="nav-item"><a href="#" class="nav-link link-dark link-opacity-25-hover py-2 px-2">О нас</a></li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link link-dark link-opacity-25-hover px-2 " id="teachprocess">
                            Учебный процесс
                        </a>
                        <ul class="p-0 py-2 drop-link" style="z-index: 1000; width: 150px; overflow-wrap:break-word;">
                            <li><a class="dropdown-item text-wrap" href="#">
                                    Дистанционное образование
                                </a>
                            </li>
                            <li><a class="dropdown-item" href="#">Расписание</a></li>
                            <li><a class="dropdown-item" href="#">Мероприятия</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a href="#" class="nav-link link-dark link-opacity-25-hover py-2 px-2">Блог</a></li>
                    <li class="nav-item"><a href="#" class="nav-link link-dark link-opacity-25-hover py-2 px-2">Новости</a></li>
                    <li class="nav-item"><a href="#" class="nav-link link-dark link-opacity-25-hover py-2 px-2">Контакты</a></li>
                </ul>
            </div>
        </nav>
    </header>
