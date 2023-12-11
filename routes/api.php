<?php

use App\Http\Controllers\api\ApiController;
use App\Http\Controllers\api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getAllPosts', [ApiController::class, 'getAllPosts']);
Route::get('/getAllSocialMedias', [ApiController::class, 'getAllSocialMedias']);
Route::get('/getAllCategories', [ApiController::class, 'getAllCategories']);
Route::get('/getAllDayOfWeeks', [ApiController::class, 'getAllDayOfWeeks']);
Route::get('/getAllPublishes', [ApiController::class, 'getAllPublishes']);
Route::get('/sliders', [ApiController::class, 'sliders']);
Route::get('/setting', [ApiController::class, 'setting']);

Route::get('/get-writer-news/{lang}', [ApiController::class, 'get_writer_news']);
Route::get('/get-news-by-category', [ApiController::class, 'get_news_by_category']);
Route::get('/get-social-media-images', [ApiController::class, 'get_social_media_images']);
Route::get('/get-all-programs', [ApiController::class, 'get_all_programs']);
Route::get('/get-news-by-id', [ApiController::class, 'get_news_by_id']);

Route::get('/get-post-category-id/{id}', [ApiController::class, 'get_post_category_id']);
Route::get('/get-related-news-by-category', [ApiController::class, 'get_related_news_by_category']);

Route::get('/get-gallary', [ApiController::class, 'get_gallary']);

Route::get('/get-news-by-category-id', [ApiController::class, 'get_news_by_category_id']);

Route::get('/get-week-days', [ApiController::class, 'get_week_days']);
Route::get('/get-day-programs', [ApiController::class, 'get_day_programs']);
Route::get('/get-categories', [ApiController::class, 'get_categories']);

Route::get('/get-search-post', [ApiController::class, 'get_search_post']);

Route::get('/get-videos', [ApiController::class, 'get_videos']);
