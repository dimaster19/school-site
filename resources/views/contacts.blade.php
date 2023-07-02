<? $title = 'Контактная информация о школе №43 г.Донецк' ?>
@include ('header')

<div class="container radius-content py-4 px-4">
{{ DiglacticBreadcrumbs::render('contacts') }}

    <div class="d-flex justify-content-center w-75 mx-auto mb-3">
        <div class=""><img src="../build/imgs/sm-logo.png" style="height: 95%; width: 95%" alt=""></div>
        <div class="">
            <h3 class="text-center fw-bold">МУНИЦИПАЛЬНОГО БЮДЖЕТНОГО ОБЩЕОБРАЗОВАТЕЛЬНОГО УЧРЕЖДЕНИЯ
                "ШКОЛА № 43 ГОРОДА ДОНЕЦКА"</h3>
        </div>
    </div>
    <div class="d-flex">
        <div class="fw-bold">Адрес:</div>
        <div class="ps-2">ДНР 83108, г.Донецк, переулок Засядько, дом 56</div>
    </div>
    <div class="d-flex">
        <div class="fw-bold">Телефон:</div>
        <div class="ps-2">+ 7 949 453-19-81</div>
    </div>
    <div class="d-flex">
        <div class="fw-bold">График работы:</div>
        <div class="ps-2">Пн - Пт, 8:00 - 17:00</div>
    </div>
    <div class="d-flex">
        <div class="fw-bold">Электронная почта:</div>
        <div class="ps-2">donschool43@yandex.ru</div>
    </div>
    <div class="w-100 d-flex justify-content-center mt-5">
        <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A6d286e6b0af4c0c0ba33cdc5aec42e3b24a600378571a509888971e4e98f6625&amp;width=800&amp;height=450&amp;lang=ru_RU&amp;scroll=true"></script>
    </div>
</div>
@include ('footer')
