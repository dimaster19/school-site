<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\ModalToggle;
use App\Models\News;
use Orchid\Screen\Actions\Button;

class NewsListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'all_news';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', '№')->sort(),
            TD::make('title', 'Заголовок')->sort(),
            TD::make('text', 'Текст')->sort(),
            TD::make('created_at', 'Создана')->render(function (News $news) {
                if (isset($news->created_at)) return $news->created_at->format('Y-m-d H:i');
            })->sort(),
            TD::make('updated_at', 'Обновлена')->render(function (News $news) {
                if (isset($news->updated_at)) return $news->updated_at->format('Y-m-d H:i');
            })->sort(),
            TD::make('edit', 'Редактирование')->render(function (News $news) {
                return ModalToggle::make('Изменить')
                    ->modal('editModal')
                    ->icon('pencil')
                    ->method('createOrUpdate')
                    ->modalTitle('Редактирование записи №' . $news->id)
                    ->asyncParameters([
                        'news' => $news->id
                    ]);
            }),
            TD::make('edit', 'Удаление')->render(function (News  $news) {
                return  Button::make('Удалить')
                ->icon('trash')
                ->method('remove',[
                    'id' => $news->id,
                ]);
            })

        ];
    }
}
