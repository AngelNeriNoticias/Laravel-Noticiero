<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\Profile;
use App\Http\Livewire\Admin\Dashboard;

use App\Http\Livewire\Admin\Catalog\TagCatalog;
use App\Http\Livewire\Admin\Catalog\PostCatalog;
use App\Http\Livewire\Admin\Catalog\ShowCatalog;
use App\Http\Livewire\Admin\Catalog\PollCatalog;
use App\Http\Livewire\Admin\Catalog\PhotoCatalog;
use App\Http\Livewire\Admin\Catalog\VideoCatalog;
use App\Http\Livewire\Admin\Catalog\CategoryCatalog;
use App\Http\Livewire\Admin\Catalog\SocialMediaCatalog;
use App\Http\Livewire\Admin\Catalog\SubCategoryCatalog;
use App\Http\Livewire\Admin\Catalog\AdvertisementCatalog;

use App\Http\Livewire\Admin\Settings\TickerSettings;

use App\Http\Livewire\Admin\System\Buttons;
use App\Http\Livewire\Admin\System\Users;

use App\Http\Livewire\Admin\Page\PageCatalog;
use App\Http\Livewire\Admin\Page\FaqCatalog;

use App\Http\Controllers\PostController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\SubCategoryController;

Route::get('/', [GeneralController::class, 'index'])->name('welcome');
Route::get('/salir', [GeneralController::class, 'logout'])->name('logout');

Route::get('/galeria-fotos', [PhotoController::class, 'index'])->name('photos');
Route::get('/galeria-videos', [VideoController::class, 'index'])->name('videos');
Route::get('/espectaculos', [ShowController::class, 'index'])->name('shows');

Route::get('/nota/{id}', [PostController::class, 'detail'])->name('detail');
Route::get('/nota/etiqueta/{id}', [PostController::class, 'tag'])->name('tag');
Route::get('/nota/fecha/{date}', [PostController::class, 'date'])->name('date');
Route::get('/nota/autor/{id}', [PostController::class, 'author'])->name('author');
Route::get('/sub-categoria/{id}', [SubCategoryController::class, 'index'])->name('sub-category');


//General Sitio
Route::get('/acerca-de', [PageController::class, 'about'])->name('about');
Route::get('/contacto', [PageController::class, 'contact'])->name('contact');
Route::get('/preguntas-frecuentes', [PageController::class, 'faq'])->name('faq');
Route::get('/terminos-condiciones', [PageController::class, 'terms'])->name('terms');
Route::get('/aviso-legal', [PageController::class, 'disclaimer'])->name('disclaimer');
Route::get('/politica-privacidad', [PageController::class, 'privacy'])->name('privacy');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])
    ->prefix('administrador')
    ->group(function () {
        Route::get('/tablero', Dashboard::class)->name('admin.dashboard');
        Route::get('/perfil', Profile::class)->name('admin.profile');

        Route::group(['prefix' => 'catalogo'], function () {
            Route::get('/etiquetas', TagCatalog::class)->name('admin.tag');
            Route::get('/fotos', PhotoCatalog::class)->name('admin.photo');
            Route::get('/videos', VideoCatalog::class)->name('admin.video');
            Route::get('/encuestas', PollCatalog::class)->name('admin.poll');
            Route::get('/categorias', CategoryCatalog::class)->name('admin.category');
            Route::get('/redes-sociales', SocialMediaCatalog::class)->name('admin.social');
            Route::get('/anuncios', AdvertisementCatalog::class)->name('admin.advertisement');
            Route::get('/subcategorias', SubCategoryCatalog::class)->name('admin.subcategory');
            Route::get('/anuncios-espectaculos', ShowCatalog::class)->name('admin.show');
        });

        Route::group(['prefix' => 'sistema'], function () {
            Route::get('/botones', Buttons::class)->name('admin.button');
            Route::get('/usuarios', Users::class)->name('admin.user');
        });

        Route::group(['prefix' => 'noticias'], function () {
            Route::get('/notas', PostCatalog::class)->name('admin.post');
            Route::get('/notas-anuncio', TickerSettings::class)->name('admin.ticker');
        });

        Route::group(['prefix' => 'paginas'], function () {
            Route::get('/contenido', PageCatalog::class)->name('admin.content');
            Route::get('/preguntas', FaqCatalog::class)->name('admin.faq');
        });
    });
