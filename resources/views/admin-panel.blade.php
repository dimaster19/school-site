@include ('header')

<div class="container radius-content py-4 px-4">
    <div class="mb-3 d-flex justify-content-center">
        <ul class="nav">
            @foreach ($tables as &$table)
            <li class="nav-item">
                <a class="nav-link" href="{{env('APP_URL').'/viewDb/'.$table}}">{{ $table }}</a>
            </li>
            @endforeach
        </ul>
    </div>
    <hr>
    <div id="app">
        <admin-panel :tables = '@json($tables)' />
    </div>
</div>


@include ('footer')
