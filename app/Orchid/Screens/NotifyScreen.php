<?php

namespace App\Orchid\Screens;

use App\Models\Notify;
use App\Orchid\Layouts\NotifyLayout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;

use Illuminate\Http\Request;

class NotifyScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */


    public function query(): iterable
    {
        return [
            'notifies' => Notify::filters()->defaultSort('id', 'asc')->paginate(20),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Список объявлений';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Добавить объявление')
                ->modal('addModal')->icon('plus-circle')
                ->method('createOrUpdate'),

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
            NotifyLayout::class,
            Layout::modal('addModal', [
                Layout::rows([
                    Input::make('notify.id')->type('hidden'),
                    Input::make('notify.title')->title('Заголовок')->required(),
                    TextArea::make('notify.text')->title('Текст')->rows(6)->required(),

                ])
            ])->title('Добавление должности')->applyButton('Добавить')->closeButton('Закрыть'),

            Layout::modal('editModal', [
                Layout::rows([
                    Input::make('notify.id')->type('hidden'),
                    Input::make('notify.title')->title('Заголовок')->required(),
                    TextArea::make('notify.text')->title('Текст')->rows(6)->required(),
                ])
            ])->title('Редактирование объявления')->async('asyncGetNotify'),
        ];
    }

    /**
     * The action that will take place when
     * the form of the modal window is submitted
     */
    public function createOrUpdate(Request $request): void
    {
        $id = $request->input('notify.id');
        $validated = $request->validate([
            'notify.title' => ['required', 'string'],
            'notify.text' => ['required'],
        ]);

        Notify::updateOrCreate(['id' => $id], $validated['notify']);
        is_null($id) ? Toast::info('Запись добавлена') : Toast::info('Запись обнавлена');
    }

    public function asyncGetNotify(Notify $notify): array
    {
        return [
            'notify' => $notify
        ];
    }


    public function remove(Request $request)
    {
        Notify::findOrFail($request->get('id'))->delete();

        Toast::info('Запись №' . $request->get('id') . ' успешно удалена');
    }
}
