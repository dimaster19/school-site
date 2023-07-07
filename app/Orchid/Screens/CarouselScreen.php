<?php

namespace App\Orchid\Screens;

use App\Http\Controllers\HomeController;
use App\Models\Attachment;
use App\View\Components\CarouselComponent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Upload;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Select;

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
            // Button::make('Добавить')->method('addPic')->icon('plus-circle'),
            // Button::make('Добавить с отчисткой')->method('addPicWithCleaning')->icon('arrow-clockwise'),
            // Button::make('Удалить картинку')->method('addPicWithCleaning')->icon('arrow-clockwise'),
            ModalToggle::make('Добавить картинки')
                ->modal('addModal')->icon('plus-circle')
                ->method('addPic'),
            Button::make('Удалить все картинки')->method('addWithClean')
                ->icon('exclamation-triangle'),
            ModalToggle::make('Удалить картинку')
                ->modal('delModal')->icon('x-circle')
                ->method('delPic'),
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
            Layout::component(CarouselComponent::class),
            Layout::modal('addModal', [
                Layout::rows([
                    Upload::make('carousel')->groups('carousel')->placeholder('Загрузить картинки')->acceptedFiles('image/*')->maxFiles(8)->title('Картинки')->required(),

                ]),
            ])->title('Добавить картинки')->applyButton('Добавить')->closeButton('Закрыть'),

            Layout::modal('delModal', [
                Layout::rows([
                    //Input::make('id')->title('ID')
                    Select::make('id')->fromQuery(Attachment::where('group', 'carousel'), 'original_name', 'id')
                ]),
            ])->title('Удалить картинку')->applyButton('Удалить')->closeButton('Закрыть'),


        ];
    }

    public function addPic()
    {
        Toast::info('Картинки добавлены');
    }

    public  function addWithClean()
    {



        $removed = DB::table('attachments')->where('group', 'carousel')->get();
        foreach ($removed as &$pic) {
            // dd($pic);
            Storage::delete($pic->path . $pic->name . '.' . $pic->extension);
        }
        DB::table('attachments')->where('group', 'carousel')->delete();

        Toast::info('Картинки удалены');
    }


    public  function delPic(Request $request)
    {
        $removed = DB::table('attachments')->where('id', $request->get('id'))->get();
        foreach ($removed as &$pic) {
            // dd($pic);
            Storage::delete($pic->path . $pic->name . '.' . $pic->extension);
        }
        DB::table('attachments')->where('id', $request->get('id'))->delete();

    }
}
