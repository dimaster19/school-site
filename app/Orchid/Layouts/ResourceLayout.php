<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\ModalToggle;
use App\Models\Resource;
use Orchid\Screen\Actions\Button;
use App\Models\Employee;

class ResourceLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'resources';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [

            TD::make('id', '№')->sort(),
            TD::make('resource_name', 'Название ресурса')->sort(),
            TD::make('resource_link', 'Ссылка'),
            TD::make('employee_id', 'Должность')->render(function (Resource $resource) {
                return Employee::find($resource->employee_id)->name;
            })->sort(),
            TD::make('created_at', 'Создана')->render(function (Resource $resource) {
                if (isset($resource->created_at)) return $resource->created_at->format('Y-m-d H:i');
            })->sort(),
            TD::make('updated_at', 'Обновлена')->render(function (Resource $resource) {
                if (isset($resource->updated_at)) return $resource->updated_at->format('Y-m-d H:i');
            })->sort(),
            TD::make('edit', 'Редактирование')->render(function (Resource $resource) {
                return ModalToggle::make('Изменить')
                    ->modal('editModal')
                    ->icon('pencil')
                    ->method('createOrUpdate')
                    ->modalTitle('Редактирование записи №' . $resource->id)
                    ->asyncParameters([
                        'resource' => $resource->id
                    ]);
            }),
            TD::make('remove', 'Удаление')->render(function (Resource  $resource) {
                return  Button::make('Удалить')
                ->icon('trash')
                ->method('remove',[
                    'id' => $resource->id,
                ]);
            })


        ];
    }
}
