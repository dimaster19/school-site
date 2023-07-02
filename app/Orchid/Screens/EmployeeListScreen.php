<?php

namespace App\Orchid\Screens;

use App\Models\Employee;
use App\Orchid\Layouts\EmployeeListLayout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Layouts\Modal;
use Orchid\Screen\Fields\Select;
use App\Models\Rank;
use Illuminate\Support\Facades\DB;

class EmployeeListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */


    public function query(): iterable
    {
        return [
            'employees' => Employee::filters()->defaultSort('id', 'asc')->paginate(20),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Список сотрудников';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Добавить сотрудника')
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
            EmployeeListLayout::class,
            Layout::modal('addModal', [
                Layout::rows([
                    Input::make('employee.id')->type('hidden'),
                    Input::make('employee.name')->title('ФИО')->required(),
                    Select::make('employee.rank_id')
                        ->fromModel(Rank::class, 'rank_name', 'id')
                        ->title('Должность')->required(),
                    Input::make('employee.full_rank')->title('Полная должность')->required(),
                    Picture::make('employee.photo')
                        ->targetRelativeUrl()
                        ->title('Фото сотрудника')->required()

                ]),
            ])->title('Добавление записи')->applyButton('Добавить')->closeButton('Закрыть'),
            Layout::modal('editModal', [
                Layout::rows([
                    Input::make('employee.id')->type('hidden')->required(),
                    Input::make('employee.name')->title('ФИО')->required(),
                    Input::make('employee.rank_id')->title('Должность')->required(),
                    Input::make('employee.full_rank')->title('Полная должность')->required(),
                    Picture::make('employee.photo')
                        ->targetRelativeUrl()
                        ->title('Фото сотрудника')->required()

                ]),
            ])->title('Редактирование записи')->async('asyncGetEmployee'),
        ];
    }

    /**
     * The action that will take place when
     * the form of the modal window is submitted
     */
    public function createOrUpdate(Request $request): void
    {
        $id = $request->input('employee.id');
        $validated = $request->validate([
            'employee.name' => ['required', 'string'],
            'employee.photo' => ['required'],
            'employee.rank_id' => ['required', 'string'],
            'employee.full_rank' => ['required', 'string']


        ]);
        Employee::updateOrCreate(['id' => $id], $validated['employee']);
        is_null($id) ? Toast::info('Запись добавлена') : Toast::info('Запись обнавлена');
    }

    public function asyncGetEmployee(Employee $employee): array
    {
        return [
            'employee' => $employee
        ];
    }


    public function remove(Request $request)
    {
        Employee::findOrFail($request->get('id'))->delete();

        Toast::info('Запись №' . $request->get('id') . ' успешно удалена');
    }
}
