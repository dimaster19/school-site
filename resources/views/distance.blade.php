<? $title = 'Дистанционное образование в школе №43 г.Донецк' ?>
@include ('header')
<div class="news-title mb-3" style="display: flex; justify-content: center; align-content: center; flex-direction: column;">
    <div class="w-100">
        <h1 class="text-center fw-bold">Дистанционное образование</h1>
    </div>
</div>
<div class="container">
    {{ DiglacticBreadcrumbs::render('distance') }}

    @foreach ($resources as &$resource_group)
    @foreach ($resource_group as $resource)

    @endforeach
    @endforeach
    <table class="table table-primary" >
        <thead>
            <tr>
                <th scope="col">Владелец</th>
                <th scope="col">Ресурс</th>
            </tr>
        </thead>
        <tbody>
            <? $flag = false ?>
            @foreach ($resources as &$resource_group)
                @foreach ($resource_group as $resource)
                    @if ($flag == false)
                        <tr>
                            <td>{{ $resource->employee->name }}</td>
                            <td><a href="{{ $resource->resource_link }}">{{ $resource->resource_name }}</a></td>
                        </tr>
                        <? $flag = true ?>
                    @else
                        <tr>
                            <td></td>
                            <td><a href="{{ $resource->resource_link }}">{{ $resource->resource_name }}</a></td>
                        </tr>
                    @endif
                @endforeach
                <? $flag = false ?>
            @endforeach


        </tbody>
    </table>
</div>
@include ('footer')
