<div class="bg-white rounded shadow-sm mb-3 p-4">
    @foreach ($imgs as $img)
        <div class="fs-5 mb-1">Картинка {{$img->original_name}} (№ {{$img->id}})</div>
        <img class="mb-3 w-100" src="{{ env('APP_URL').'/storage/'.$img->path.$img->name.'.'.$img->extension}}" alt="{{$img->original_name}}">
    @endforeach
</div>
