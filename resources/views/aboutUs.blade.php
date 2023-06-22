@include ('header')

<div class="news-title mb-3" style="display: flex; justify-content: center; align-content: center; flex-direction: column;">
    <div class="w-100">
        <h1 class="text-center fw-bold">О школе №43 г.Донецк</h1>
    </div>
</div>
<div class="container py-4 ">
{{ Breadcrumbs::render('about-us') }}
    <div class="radius-content">
        <div>
        <img  src="../build/imgs/school.jpg" style="width: 100%; height: auto;  border-radius: 8px 8px 0 0 " alt="Фото школы №43 г.Донецк">
        </div>
        <div class="py-3 px-3" style=" text-align: justify; ">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi repudiandae ab cum facilis ullam ipsa porro ratione esse fugit, exercitationem expedita delectus animi mollitia commodi velit, placeat ea, aperiam quibusdam.</div>
    </div>

    <h1 class="text-center mt-3">Наши сотрудники</h1>

    <h2 style="margin-bottom: 0px !important">Директор</h2>
    <div class="row">
        @foreach ($workers->director as $worker)
        <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
            <div class="card">
                <img src="{{ env('APP_URL')}}/build/imgs/workers/{{ $worker->photo }}" style="width: 100%; height: 71%" class="card-img-top" alt="img">
                <div class="card-body">
                    <h4 class="card-title">{{ $worker->name }}</h4>
                    <div>{{ $worker->full_rank }}</div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <h2 style="margin-bottom: 0px !important" class="mt-3">Заместители директора</h2>
    <div class="row">
        @foreach ($workers->vice_directors as $worker)
        <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
            <div class="card">
                <img src="https://imgholder.ru/350x250/8493a8/adb9ca&text=IMAGE+HOLDER&font=kelson" style="width: 100%; height: 71%" class="card-img-top" alt="img">
                <div class="card-body">
                    <h4 class="card-title">{{ $worker->name }}</h4>
                    <div>{{ $worker->full_rank }}</div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <h2 style="margin-bottom: 0px !important" class="mt-3">Учителя и воспитатели</h2>
    <div class="row">
        @foreach ($workers->teachers as $worker)
        <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
            <div class="card">
                <img src="https://imgholder.ru/350x250/8493a8/adb9ca&text=IMAGE+HOLDER&font=kelson" style="width: 100%; height: 71%" class="card-img-top" alt="img">
                <div class="card-body">
                    <h4 class="card-title">{{ $worker->name }}</h4>
                    <div>{{ $worker->full_rank }}</div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@include ('footer')
