<? $title = "Учебный процесс в школе №43 г.Донецк" ?>
@include ('header')

<div class="container radius-content py-4 px-4">
    <h3 class="text-center fw-bold mb-3">Учебный процесс</h3>

    <div class="w-100 m-auto text-center mb-3"><img style="width: 100%; height: auto; max-width:1000px" src="{{ env('APP_URL').'/build/imgs/study.jpg' }}" alt="Учеба"></div>
    <a href="{{ env('APP_URL').'/distancionnoe-obuchenie'}}" class="nav-link link-dark shadow p-3 mb-3 rounded link-opacity-25-hover" >Дистанционное образование</a>
    <a href="{{ env('APP_URL').'/raspisanie'}}" class="nav-link link-dark shadow p-3 mb-3 rounded link-opacity-25-hover" >Расписание</a>
    <a href="{{ env('APP_URL').'/meroptiatiya'}}" class="nav-link link-dark shadow p-3 mb-3 rounded link-opacity-25-hover">Мероприятия</a>

</div>

@include ('footer')
