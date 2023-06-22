<?php

namespace App\Orchid\Screens;

use App\Models\Rank;
use App\Orchid\Layouts\RankListLayout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Illuminate\Http\Request;

class RankScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */


    public function query(): iterable
    {
        return [
            'ranks' => Rank::filters()->defaultSort('id', 'asc')->paginate(20)
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Список должностей';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Добавить должность')
            ->modal('addModal')
            ->method('action')
            ->icon('frame')
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
            RankListLayout::class,
            Layout::modal('addModal', [
                Layout::rows([
                    Input::make('rank_name')->title('Название должности')->required()

                ]),
            ])->title('Добавление должности')
                ->applyButton('Добавить')
                ->closeButton('Закрыть'),
        ];
    }

    /**
     * The action that will take place when
     * the form of the modal window is submitted
     */
    public function action(Request $request): void
    {
        $validated = $request->validate([
            'rank_name' => ['required', 'string']
        ]);

        Rank::create($validated);
        Toast::info('Новая должность добавлена');
    }
}
