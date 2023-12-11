<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DayOfWeekController;
use App\Http\Controllers\GalaryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\PublishController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
  return redirect()->route('login');
});

Auth::routes();



Route::get('/home', [HomeController::class, 'index'])->name('home');
// Route::resource('post', [PostController::class], [
//   'names' => [
//     'index' => 'post.index',
//     'create' => 'post.create',
//     'store' => 'post.store',
//     'edit' => 'post.edit',
//     'update' => 'post.update',
//     'destroy' => 'post.delete',
//   ],
// ]);


// Route::resource('post', PostController::class);
Route::group(['controller' => PostController::class], function () {
  Route::get('/post', 'index')->name('post.index');
  Route::post('/post', 'store')->name('post.store');
  Route::get('/post/create', 'create')->name('post.create');
  Route::put('/post/{post}', 'update')->name('post.update');
  Route::get('/post/{post?}', 'destroy')->name('post.delete');
  Route::get('/post/{post}/edit', 'edit')->name('post.edit');
});

Route::get('/trash', [PostController::class, 'trash'])->name('post.trash');
Route::delete('/force-delete/{id}', [PostController::class, 'delete'])->name('post.force-delete');
Route::get('/restore/{id}', [PostController::class, 'restore'])->name('post.restore');

// Route::resource('/category', CategoryController::class);
Route::group(['controller' => CategoryController::class], function () {
  Route::get('/category', 'index')->name('category.index');
  Route::post('/category', 'store')->name('category.store');
  Route::get('/category/create', 'create')->name('category.create');
  Route::put('/category/{category}', 'update')->name('category.update');
  Route::delete('/category/{category}', 'destroy')->name('category.delete');
  Route::get('/category/{category}/edit', 'edit')->name('category.edit');
});

// Route::resource('/tag', TagController::class);
Route::group(['controller' => TagController::class], function () {
  Route::get('/tag', 'index')->name('tag.index');
  Route::post('/tag', 'store')->name('tag.store');
  Route::get('/tag/create', 'create')->name('tag.create');
  Route::put('/tag/{tag}', 'update')->name('tag.update');
  Route::delete('/tag/{tag}', 'destroy')->name('tag.delete');
  Route::get('/tag/{tag}/edit', 'edit')->name('tag.edit');
});

// Route::resource('/day_of_week', DayOfWeekController::class);
Route::group(['controller' => DayOfWeekController::class], function () {
  Route::get('/day_of_week', 'index')->name('day_of_week.index');
  Route::post('/day_of_week', 'store')->name('day_of_week.store');
  Route::get('/day_of_week/create', 'create')->name('day_of_week.create');
  Route::put('/day_of_week/{day_of_week}', 'update')->name('day_of_week.update');
  Route::delete('/day_of_week/{day_of_week}', 'destroy')->name('day_of_week.delete');
  Route::get('/day_of_week/{day_of_week}/edit', 'edit')->name('day_of_week.edit');
});

// Route::resource('/slider', SliderController::class);
Route::group(['controller' => SliderController::class], function () {
  Route::get('/slider', 'index')->name('slider.index');
  Route::post('/slider', 'store')->name('slider.store');
  Route::get('/slider/create', 'create')->name('slider.create');
  Route::put('/slider/{slider}', 'update')->name('slider.update');
  Route::delete('/slider/{slider}', 'destroy')->name('slider.delete');
  Route::get('/slider/{slider}/edit', 'edit')->name('slider.edit');
});

// Route::resource('/slider', SliderController::class);
Route::group(['controller' => GalaryController::class], function () {
  Route::get('/galary', 'index')->name('galary.index');
  Route::post('/galary', 'store')->name('galary.store');
  Route::get('/galary/create', 'create')->name('galary.create');
  Route::put('/galary/{galary}', 'update')->name('galary.update');
  Route::delete('/galary/{galary}', 'destroy')->name('galary.delete');
  Route::get('/galary/{galary}/edit', 'edit')->name('galary.edit');
});

// Route::resource('/program', ProgramController::class);
Route::group(['controller' => ProgramController::class], function () {
  Route::get('/program', 'index')->name('program.index');
  Route::post('/program', 'store')->name('program.store');
  Route::get('/program/create', 'create')->name('program.create');
  Route::put('/program/{program}', 'update')->name('program.update');
  Route::delete('/program/{program}', 'destroy')->name('program.delete');
  Route::get('/program/{program}/edit', 'edit')->name('program.edit');
});


// Route::resource('/social_media', SocialMediaController::class);
Route::group(['controller' => SocialMediaController::class], function () {
  Route::get('/social_media', 'index')->name('social_media.index');
  Route::post('/social_media', 'store')->name('social_media.store');
  Route::get('/social_media/create', 'create')->name('social_media.create');
  Route::put('/social_media/{social_media}', 'update')->name('social_media.update');
  Route::delete('/social_media/{social_media}', 'destroy')->name('social_media.delete');
  Route::get('/social_media/{social_media}/edit', 'edit')->name('social_media.edit');
});

// Route::resource('/contact', ContactController::class);
Route::group(['controller' => ContactController::class], function () {
  Route::get('/contact', 'index')->name('contact.index');
  Route::post('/contact', 'store')->name('contact.store');
  Route::get('/contact/create', 'create')->name('contact.create');
  Route::put('/contact/{contact}', 'update')->name('contact.update');
  Route::delete('/contact/{contact}', 'destroy')->name('contact.delete');
  Route::get('/contact/{contact}/edit', 'edit')->name('contact.edit');
});

// Route::resource('/publish', PublishController::class);
Route::group(['controller' => PublishController::class], function () {
  Route::get('/publish', 'index')->name('publish.index');
  Route::post('/publish', 'store')->name('publish.store');
  Route::get('/publish/create', 'create')->name('publish.create');
  Route::put('/publish/{publish}', 'update')->name('publish.update');
  Route::delete('/publish/{publish}', 'destroy')->name('publish.delete');
  Route::get('/publish/{publish}/edit', 'edit')->name('publish.edit');
});

// Route::resource('/setting', SettingController::class);
Route::group(['controller' => SettingController::class], function () {
  Route::get('/setting', 'index')->name('setting.index');
  Route::post('/setting', 'store')->name('setting.store');
  Route::get('/setting/create', 'create')->name('setting.create');
  Route::put('/setting/{setting}', 'update')->name('setting.update');
  Route::delete('/setting/{setting}', 'destroy')->name('setting.delete');
  Route::get('/setting/{setting}/edit', 'edit')->name('setting.edit');
});

// Route::resource('/video', SettingController::class);
Route::group(['controller' => VideoController::class], function () {
  Route::get('/video', 'index')->name('video.index');
  Route::post('/video', 'store')->name('video.store');
  Route::get('/video/create', 'create')->name('video.create');
  Route::put('/video/{video}', 'update')->name('video.update');
  Route::delete('/video/{video}', 'destroy')->name('video.delete');
  Route::get('/video/{video}/edit', 'edit')->name('video.edit');
});


Route::get('/locale/{locale}', function ($locale) {
  app()->setlocale($locale);
  Session()->put('locale', $locale);
  return redirect()->back();
})->name('locale');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['auth']], function () {



  \UniSharp\LaravelFilemanager\Lfm::routes();
});


# --------------------------------- Users Routes -------------------------------------------------------------------
Route::get('users', [UserController::class, 'index'])->middleware('auth')->name('users.index');
Route::post('users-store', [UserController::class, 'store'])->middleware('auth')->name('users.store');
Route::post('users-update', [UserController::class, 'update'])->middleware('auth')->name('users.update');
Route::get('user-delete/{id}', [UserController::class, 'destroy'])->middleware('auth')->name('users.delete');
Route::get('profile', [UserController::class, 'profile'])->middleware('auth')->name('profile');
Route::post('update/profile', [UserController::class, 'update_profile'])->middleware('auth')->name('update.profile');
Route::post('change_password', [UserController::class, 'change_password'])->middleware('auth')->name('change-user-password');
Route::get('users/roles', [UserController::class, 'roles'])->middleware('auth')->name('user.roles');
Route::post('users/role-store', [UserController::class, 'role_store'])->middleware('auth')->name('role.store');
Route::get('users/role-edit', [UserController::class, 'role_edit'])->middleware('auth')->name('role.edit');
Route::post('users/role-update', [UserController::class, 'role_update'])->middleware('auth')->name('role.update');
# --------------------------------- End Users Routes ------------------------------------------------------------------


Route::get('/config', function () {
  Artisan::call('key:generate');
  Artisan::call('storage:link');
  Artisan::call('config:cache');
});