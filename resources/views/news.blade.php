@include('header')

<div class="news-title mb-3" style="display: flex; justify-content: center; align-content: center; flex-direction: column;">
    <div class="w-100">
        <h1 class="text-center fw-bold">{{$news->title}}</h1>
        <div class="d-flex justify-content-between w-25 mx-auto">
            <div class="news-date text-center w-100">
                {{ $news->updated_at->format('Y-m-d , H:i')}}
            </div>
        </div>
    </div>
</div>

<div class="container">
    {{ DiglacticBreadcrumbs::render('news-name', $news) }}

    <div class="w-100 radius-content py-4 px-4 mb-4">
        <p class="fs-4 mt-2" style="text-align: justify; white-space: pre-line">{{$news->text}}</p>

        <div id="carouselExampleDark" class="carousel slide mt-4 mb-4  news-carousel" data-bs-ride="carousel">

            <div class="carousel-inner" style="border-radius: 8px;">
                @foreach ($news->attachment as $pic)
                <div class="carousel-item" data-bs-interval="4000" style="height: 400px;">
                    <img src="{{ $pic->url() }}" class="d-block mx-auto" style="height: 100%" alt="{{ $pic->original_name}}">
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>


        <div class="row news-gallery">
            @foreach ($news->attachment as $pic)
            <div class="col-md-6 col-sm-12 mt-3">
                <div class="card">
                    <img src="{{ $pic->url() }}" class="d-block mx-auto" style="width: 100%" alt="{{ $pic->original_name}}">
                </div>
            </div>
            @endforeach
        </div>


    </div>

</div>

@include('footer')

<script type="text/javascript">
    let elem = document.getElementsByClassName('carousel-item')[0]
    elem.classList.add('active');
</script>
