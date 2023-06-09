@include ('header')
<div class="news-title mb-3" style="display: flex; justify-content: center; align-content: center; flex-direction: column;">
    <div class="w-100">
        <h1 class="text-center fw-bold">Новости</h1>
    </div>
</div>



<div class="container">
{{DiglacticBreadcrumbs::render('news') }}

    <div class="row" >
        @foreach ($news as $item)
        <div class="col-lg-6 col-md-12 mt-3">
            <a class="card-link"  href="{{ env('APP_URL').'/novosti/'.$item->id.'-'.str_replace(' ', '-', $item->title)}}">
                <div class="card" >
                    <img src="{{env('APP_URL')}}{{$item->mainimg}}" style="width: auto; height: 100%; " class="card-img-top" alt="img">
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
    <div class="mt-4 w-100 d-flex justify-content-center">
        {{ $news->links() }}
    </div>
</div>
@include ('footer')
