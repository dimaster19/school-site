<div class="bg-white rounded shadow-sm mb-3 p-4">
    @for ($i = 2; $i < count($imgs) + 2;  $i++)
        <div class="fs-5 mb-1">Картинка №{{$i-1}}</div>
        <img class="mb-3 w-100" src="{{ env('APP_URL').'/build/imgs/carousel/'.$imgs[$i]}}" alt="$imgs[$i]">
    @endfor
</div>
