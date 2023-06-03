@include ('header')

<div class="container radius-content py-4 px-4">
    <div class="mb-3 d-flex justify-content-center">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="/adminpanel/products">Товары</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/adminpanel/categories">Категории</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/adminpanel/manufactures">Производители</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/adminpanel/orders">Заказы</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/adminpanel/users">Пользователи</a>
            </li>
        </ul>
    </div>
    <hr>
    <div id="app">
        <admin-panel :tables = '@json($tables)' />
    </div>
</div>


@include ('footer')
