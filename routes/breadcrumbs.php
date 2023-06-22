<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

use App\Models\News;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Главная', route('glavnaya'));
});

// Home > News
Breadcrumbs::for('news', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Новости', route('novosti'));
});

// Home > News > Name
Breadcrumbs::for('news-name', function (BreadcrumbTrail $trail, News $news) {
    $trail->parent('news');
    $trail->push($news->title, route('novost', $news));
});

// Home > About Us
Breadcrumbs::for('about-us', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('О нас', route('o-nas'));
});

// Home > Distance Educ
Breadcrumbs::for('distance', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Дистанционное обучение', route('distance'));
});

// Home > Contacts
Breadcrumbs::for('contacts', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Контакты', route('contacts'));
});
