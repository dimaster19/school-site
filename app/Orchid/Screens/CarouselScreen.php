<?php

namespace App\Orchid\Screens;

use App\Http\Controllers\HomeController;
use App\View\Components\CarouselComponent;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Button;

class CarouselScreen extends Screen
{

    // МОДАЛКИ ДЛЯ ОТПРАВКИ КАРТИНОК и УДАЛЕНИЯ ОПРЕДЕЛЕННОЁ КАРТИНКИ (ПО ИМЕНИ ИЛИ НОМЕРУ С УЧЁТОМ -2)
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $controller = new HomeController();

        return [
            'imgs' => $controller->getCarousel(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Карусель';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Добавить')->method('addPic')->icon('plus-circle'),
            Button::make('Добавить с отчисткой')->method('addPicWithCleaning')->icon('arrow-clockwise'),
            Button::make('Удалить картинку')->method('addPicWithCleaning')->icon('arrow-clockwise'),

        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::component(CarouselComponent::class)
        ];
    }

    public function addPic() {

    }

    public  function addPicWithCleaning() {

    }
}
