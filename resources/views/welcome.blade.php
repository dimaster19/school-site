@include('header')
<div class="d-flex w-100 justify-content-center">
    <div id="carouselExampleFade" class="carousel slide carousel-fade mb-4" style="width: 1920px" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($carousel as $img)
            <div class="carousel-item">
                <a class=""><img src="{{ env('APP_URL').'/build/imgs/carousel/'.$img}}" style="max-height: 550px; max-width: 1920px" class="d-block w-100" alt="{{$img}}"></a>
            </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<div class="container">
    <h2 class="text-center border-bottom pb-3 mb-4">Объявление</h2>
    <div class="w-100 radius-content py-4 px-4 mb-4">
    <h3 class="fs-4 fw-bold">{{ $notify->title }}</h3>
        <p class="fs-4 mt-2" style="text-align: justify; white-space: pre-line">{{ $notify->text }}</p>
    </div>
    <h2 class="text-center border-bottom pb-3">Новости школы</h2>
    <div class="row">
        @foreach ($news as $item)
        <div class="col-lg-6 col-md-12 mt-3">
            <a class="card-link" href="{{ env('APP_URL').'/novosti/'.$item->id.'-'.str_replace(' ', '-', $item->title)}}">
                <div class="card">
                    <img src="{{env('APP_URL')}}/build/imgs/news/{{$item->mainimg}}" style="width: 100%; height: auto" class="card-img-top" alt="img">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <p class="card-text" style="min-height: 77px;">{{substr($item->text, 0, 200)}}...</p>
                        <p class="card-text"><small class="text-muted">{{ $item->updated_at->format('Y-m-d , H:i')}}</small></p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>

@include('footer')

<script type="text/javascript">
    let elem = document.getElementsByClassName('carousel-item')[0]
    elem.classList.add('active');
</script>
