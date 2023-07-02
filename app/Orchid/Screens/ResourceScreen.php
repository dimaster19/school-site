<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use App\Models\Resource;
use App\Orchid\Layouts\ResourceLayout;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use App\Models\Employee;

use Illuminate\Http\Request;

class ResourceScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */


    public function query(): iterable
    {
        return [
            'resources' => Resource::filters()->defaultSort('id', 'asc')->paginate(20),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Список ресурсов преподавателей';
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
            ResourceLayout::class,
            Layout::modal('addModal', [
                Layout::rows([
                    Input::make('resource.id')->type('hidden'),
                    Input::make('resource.resource_name')->title('Название ресурсы')->required(),
                    Input::make('resource.resource_link')->title('Ссылка')->required(),
                    Select::make('resource.employee_id')
                    ->fromModel(Employee::class, 'name', 'id')
                    ->title('Сотрудник')->required(),
                ])
            ])->title('Добавление должности')->applyButton('Добавить')->closeButton('Закрыть'),

            Layout::modal('editModal', [
                Layout::rows([
                    Input::make('resource.id')->type('hidden'),
                    Input::make('resource.resource_name')->title('Название ресурсы')->required(),
                    Input::make('resource.resource_link')->title('Ссылка')->required(),
                    Select::make('resource.employee_id')
                    ->fromModel(Employee::class, 'name', 'id')
                    ->title('Сотрудник')->required(),
                ]),
            ])->title('Редактирование должности')->async('asyncGetResource'),
        ];
    }

    /**
     * The action that will take place when
     * the form of the modal window is submitted
     */
    public function createOrUpdate(Request $request): void
    {
        $id = $request->input('resource.id');
        $validated = $request->validate([
            'resource.resource_name' => ['required', 'string'],
            'resource.resource_link' => ['required', 'string'],
            'resource.employee_id' => ['required', 'integer'],
        ]);
        Resource::updateOrCreate(['id' => $id], $validated['resource']);
        is_null($id) ? Toast::info('Запись добавлена') : Toast::info('Запись обнавлена');
    }

    public function asyncGetResource(Resource $resource): array
    {
        return [
            'resource' => $resource
        ];
    }


    public function remove(Request $request)
    {
        Resource::findOrFail($request->get('id'))->delete();

        Toast::info('Запись №' . $request->get('id') . ' успешно удалена');
    }
}
