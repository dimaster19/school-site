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
{{ Breadcrumbs::render('news-name', $news) }}

    <div class="w-100 radius-content py-4 px-4 mb-4">
        <p class="fs-4 mt-2" style="text-align: justify; white-space: pre-line">{{$news->text}}</p>

        <div id="carouselExampleDark" class="carousel slide mt-4 mb-4" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner" style="border-radius: 8px;">
                <div class="carousel-item active" data-bs-interval="10000">
                <img src="../build/imgs/test.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                <img src="../build/imgs/test.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="../build/imgs/test.jpg" class="d-block w-100" alt="...">
                </div>
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
    </div>

</div>

@include('footer')
