<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\ModalToggle;
use App\Models\Rank;
use Orchid\Screen\Actions\Button;

class RankListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'ranks';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', '№')->sort(),
            TD::make('rank_name', 'Должность')->sort()->filter(TD::FILTER_TEXT),
            TD::make('created_at', 'Создана')->render(function (Rank $rank) {
                if (isset($rank->created_at)) return $rank->created_at->format('Y-m-d H:i');
            })->sort(),
            TD::make('updated_at', 'Обновлена')->render(function (Rank $rank) {
                if (isset($rank->updated_at)) return $rank->updated_at->format('Y-m-d H:i');
            })->sort(),
            TD::make('edit', 'Редактирование')->render(function (Rank $rank) {
                return ModalToggle::make('Изменить')
                    ->modal('editModal')
                    ->icon('pencil')
                    ->method('createOrUpdate')
                    ->modalTitle('Редактирование записи №' . $rank->id)
                    ->asyncParameters([
                        'rank' => $rank->id
                    ]);
            }),
            TD::make('remove', 'Удаление')->render(function (Rank $rank) {
                return  Button::make('Удалить')
                ->icon('trash')
                ->method('remove',[
                    'id' => $rank->id,
                ]);
            })
        ];
    }

    // protected function timeRender(Rank $rank) {

    // }
}
