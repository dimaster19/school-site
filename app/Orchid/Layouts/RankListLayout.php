<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use App\Models\Rank;

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
        ];
    }

    // protected function timeRender(Rank $rank) {

    // }
}
