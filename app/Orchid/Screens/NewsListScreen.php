<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use App\Models\News;
use App\Orchid\Layouts\NewsListLayout;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Layouts\Modal;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;

class NewsListScreen extends Screen
{
    /**
    * Fetch data to be displayed on the screen.
    *
    * @return array
    */


   public function query(): iterable
   {
       return [
           'all_news' => News::filters()->defaultSort('id', 'asc')->paginate(20),
       ];
   }

   /**
    * The name of the screen displayed in the header.
    *
    * @return string|null
    */
   public function name(): ?string
   {
       return 'Список новостей';
   }

   /**
    * The screen's action buttons.
    *
    * @return \Orchid\Screen\Action[]
    */
   public function commandBar(): iterable
   {
       return [
           ModalToggle::make('Добавить новость')
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
           NewsListLayout::class,
           Layout::modal('addModal', [
               Layout::rows([
                Input::make('news.id')->type('hidden'),
                Input::make('news.title')->title('Заголовок')->required(),
                TextArea::make('news.text')->title('Текст')->required(),
                Picture::make('news.mainimg')
                    ->targetRelativeUrl()
                    ->title('Главная картинка')->required(),
                    Upload::make('news.attachment')->groups('news')->placeholder('Загрузить картинки')->acceptedFiles('image/*')->maxFiles(8)->title('Остальные картинки')->required()
                ]),
           ])->title('Добавление записи')->applyButton('Добавить')->closeButton('Закрыть'),


           Layout::modal('editModal', [
               Layout::rows([
                Input::make('news.id')->type('hidden'),
                Input::make('news.title')->title('Заголовок')->required(),
                TextArea::make('news.text')->title('Текст')->required(),
                Picture::make('news.mainimg')
                    ->targetRelativeUrl()
                    ->title('Главная картинка')->required(),
                 Upload::make('news.attachment')->groups('news')->placeholder('Загрузить картинки')->acceptedFiles('image/*')->maxFiles(8)->title('Остальные картинки')->required()

               ]),
           ])->title('Редактирование записи')->async('asyncGetNews'),
       ];
   }

   /**
    * The action that will take place when
    * the form of the modal window is submitted
    */
   public function createOrUpdate(Request $request): void
   {
       $id = $request->input('news.id');
       $validated = $request->validate([
           'news.title' => ['required', 'string'],
           'news.text' => ['required'],
           'news.mainimg' => ['required'],
       ]);
       $news = News::updateOrCreate(['id' => $id], $validated['news']);
       $news->attachment()->syncWithoutDetaching($request->input('news.attachment', []));
       is_null($id) ? Toast::info('Запись добавлена') : Toast::info('Запись обнавлена');
   }

   public function asyncGetNews(News $news): array
   {
       $news->load('attachment');
       return [
           'news' => $news
       ];
   }


   public function remove(Request $request)
   {
       News::findOrFail($request->get('id'))->delete();

       Toast::info('Запись №' . $request->get('id') . ' успешно удалена');
   }
}
