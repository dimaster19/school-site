<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\ModalToggle;
use App\Models\Employee;
use Orchid\Screen\Actions\Button;
use App\Models\Rank;

class EmployeeListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'employees';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [

            TD::make('id', '№')->sort(),
            TD::make('name', 'ФИО')->sort(),
            TD::make('rank_id', 'Должность')->render(function (Employee $employee) {
                return Rank::find($employee->rank_id)->rank_name;
            })->sort(),
            TD::make('full_rank', 'Полная должность')->sort(),
            TD::make('created_at', 'Создана')->render(function (Employee $employee) {
                if (isset($employee->created_at)) return $employee->created_at->format('Y-m-d H:i');
            })->sort(),
            TD::make('updated_at', 'Обновлена')->render(function (Employee $employee) {
                if (isset($employee->updated_at)) return $employee->updated_at->format('Y-m-d H:i');
            })->sort(),
            TD::make('edit', 'Редактирование')->render(function (Employee $employee) {
                return ModalToggle::make('Изменить')
                    ->modal('editModal')
                    ->icon('pencil')
                    ->method('createOrUpdate')
                    ->modalTitle('Редактирование записи №' . $employee->id)
                    ->asyncParameters([
                        'employee' => $employee->id
                    ]);
            }),
            TD::make('edit', 'Удаление')->render(function (Employee  $employee) {
                return  Button::make('Удалить')
                ->icon('trash')
                ->method('remove',[
                    'id' => $employee->id,
                ]);
            })

        ];
    }
}
