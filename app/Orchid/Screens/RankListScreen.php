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

class RankListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */


    public function query(): iterable
    {
        return [
            'ranks' => Rank::filters()->defaultSort('id', 'asc')->paginate(20),
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
                ->modal('addModal')->icon('plus')
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
            RankListLayout::class,
            Layout::modal('addModal', [
                Layout::rows([
                    Input::make('rank.id')->type('hidden'),
                    Input::make('rank.rank_name')->title('Название должности')->required()

                ]),
            ])->title('Добавление должности')->applyButton('Добавить')->closeButton('Закрыть'),
            Layout::modal('editModal', [
                Layout::rows([
                    Input::make('rank.id')->type('hidden'),
                    Input::make('rank.rank_name')->title('Название должности')->required()

                ]),
            ])->title('Редактирование клиента')->async('asyncGetRank'),
        ];
    }

    /**
     * The action that will take place when
     * the form of the modal window is submitted
     */
    public function createOrUpdate(Request $request): void
    {
        $id = $request->input('rank.id');
        $validated = $request->validate([
            'rank.rank_name' => ['required', 'string']
        ]);
        Rank::updateOrCreate(['id' => $id], $validated['rank']);
        is_null($id) ? Toast::info('Запись добавлена') : Toast::info('Запись обнавлена');
    }

    public function asyncGetRank(Rank $rank): array
    {
        return [
            'rank' => $rank
        ];
    }


    public function remove(Request $request)
    {
        Rank::findOrFail($request->get('id'))->delete();

        Toast::info('Запись №'.$request->get('id').' успешно удалена');


    }
}
