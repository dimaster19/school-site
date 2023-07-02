<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\ModalToggle;
use App\Models\Notify;
use Orchid\Screen\Actions\Button;

class NotifyLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'notifies';

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
            TD::make('created_at', 'Создана')->render(function (Notify $notify) {
                if (isset($notify->created_at)) return $notify->created_at->format('Y-m-d H:i');
            })->sort(),
            TD::make('updated_at', 'Обновлена')->render(function (Notify $notify) {
                if (isset($notify->updated_at)) return $notify->updated_at->format('Y-m-d H:i');
            })->sort(),
            TD::make('edit', 'Редактирование')->render(function (Notify $notify) {
                return ModalToggle::make('Изменить')
                    ->modal('editModal')
                    ->icon('pencil')
                    ->method('createOrUpdate')
                    ->modalTitle('Редактирование записи №' . $notify->id)
                    ->asyncParameters([
                        'notify' => $notify->id
                    ]);
            }),
            TD::make('remove', 'Удаление')->render(function (Notify  $notify) {
                return  Button::make('Удалить')
                ->icon('trash')
                ->method('remove',[
                    'id' => $notify->id,
                ]);
            })

        ];
    }
}
