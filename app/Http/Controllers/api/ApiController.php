<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\DayOfWeek;
use App\Models\DayOfWeekProgram;
use App\Models\Galary;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Program;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\SocialMedia;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Json;

class ApiController extends Controller
{
    protected function getAllPosts()
    {
        $post = Post::with('categories')->orderByDesc('created_at')->get();
        return $post;
    }

    protected function get_news_by_category(Request $request)
    {
        $data = Post::join('post_categories', 'post_categories.post_id', 'posts.id')
            ->join('categories', 'categories.id', 'post_categories.category_id')
            ->join('images', 'images.imageable_id', 'posts.id')
            ->select(
                'posts.id',
                'posts.title as title',
                'posts.description as description',
                DB::raw('DATE_FORMAT(posts.created_at, "%Y-%m-%d") as created_date'),
                DB::raw('DATE_FORMAT(posts.created_at, "%h:%i:%s %p") as created_time'),
                // DB::raw('TIMEDIFF(now(), posts.created_at) as diff'),
                'categories.' . $request->lang . '_name as category_name',
                'images.image'
            )
            ->where(['categories.id' => $request->category_id, 'images.imageable_type' => 'App\Models\Post', 'posts.post_type' => $request->lang])
            ->when($request->category_id == '10', function($data){
                return $data->limit(4);
            })
            ->orderBy('posts.id', 'DESC')
            ->get();

        return response()->json($data);
    }

    protected function getAllSocialMedias()
    {
        $socialMedia = SocialMedia::where('status', '1')->get();
        return $socialMedia;
    }
    protected function getAllCategories()
    {
        $category = Category::where('status', '1')->get();
        return $category;
    }

    protected function get_all_programs(Request $request)
    {
        $data = Program::join('images', 'images.imageable_id', 'programs.id')
            ->select(
                'programs.id',
                'programs.' . $request->lang . '_title as title',
                'programs.' . $request->lang . '_description as description',
                'images.image',
                DB::raw('TIME_FORMAT(start, "%h:%i %p") as start_time'),
                DB::raw('TIME_FORMAT(end, "%h:%i %p") as end_time')
            )
            ->where(['programs.status' => '1', 'images.imageable_type' => 'App\Models\Program'])
            ->whereDate('programs.created_at', date('Y-m-d'))
            ->get();
        return response()->json($data);
    }

    protected function getAllDayOfWeeks()
    {
        $dayOfWeek = DayOfWeek::where('status', '1')->get();
        return $dayOfWeek;
    }
    protected function getAllPublishes()
    {
        $publishes = DayOfWeek::with('programs')->get();
        return $publishes;
    }
    protected function sliders()
    {
        $sliders = Slider::where('status', '1')->get();
        foreach ($sliders as $slider) {
            $image = $slider->image;
        }
        // return response(json_encode($image, $sliders));
        return response($sliders);
    }

    protected function setting()
    {
        return Setting::find(1)->first();
    }

    protected function get_writer_news($lang)
    {
        $data = Post::where('post_type', $lang)->get(['title as title']);

        return response()->json($data);
    }

    protected function get_social_media_images()
    {
        $data = SocialMedia::all();

        return response()->json($data);
    }

    protected function get_news_by_id(Request $request)
    {
        $data = Post::join('post_categories', 'post_categories.post_id', 'posts.id')
            ->join('categories', 'categories.id', 'post_categories.category_id')
            ->join('images', 'images.imageable_id', 'posts.id')
            ->select(
                'posts.id',
                'posts.title as title',
                'posts.sub_title as sub_title',
                'posts.description as description',
                'categories.' . $request->lang . '_name as category_name',
                'images.image',
                DB::raw('DATE_FORMAT(posts.created_at, "%Y-%m-%d") as created_date'),
                DB::raw('DATE_FORMAT(posts.created_at, "%h:%i:%s %p") as created_time')
            )
            ->where(['posts.id' => $request->id, 'images.imageable_type' => 'App\Models\Post', 'posts.post_type' => $request->lang])
            ->orderBy('posts.id', 'DESC')
            ->first();

        return response()->json($data);
    }

    protected function get_post_category_id($id)
    {
        $data = PostCategory::where('post_id', $id)->first();

        return response()->json($data);
    }

    protected function get_related_news_by_category(Request $request)
    {
        $data = Post::join('post_categories', 'post_categories.post_id', 'posts.id')
            ->join('categories', 'categories.id', 'post_categories.category_id')
            ->join('images', 'images.imageable_id', 'posts.id')
            ->select(
                'posts.id',
                'posts.title as title',
                'posts.description as description',
                DB::raw('DATE_FORMAT(posts.created_at, "%Y-%m-%d") as created_date'),
                DB::raw('DATE_FORMAT(posts.created_at, "%h:%i:%s") as created_time'),
                'categories.' . $request->lang . '_name as category_name',
                'images.image'
            )
            ->where('posts.id', '!=', $request->id)
            ->where(['categories.id' => $request->category_id, 'images.imageable_type' => 'App\Models\Post', 'posts.post_type' => $request->lang])
            ->orderBy('posts.id', 'DESC')
            ->limit(4)
            ->get();

        return response()->json($data);
    }

    protected function get_gallary(Request $request)
    {
        $data = Galary::join('images', 'images.imageable_id', 'galaries.id')
            ->select(
                'galaries.id',
                'galaries.' . $request->lang . '_title as title',
                'images.image'
            )
            ->where(['images.imageable_type' => 'App\Models\Galary'])
            ->orderBy('galaries.id', 'DESC')
            ->limit(5)
            ->get();

        return response()->json($data);
    }

    protected function get_news_by_category_id(Request $request)
    {
        $pageSize = 10;

        if ($request->has('size')) {
            $pageSize = $request->size;
        }

        $data = Post::join('post_categories', 'post_categories.post_id', 'posts.id')
            ->join('categories', 'categories.id', 'post_categories.category_id')
            ->join('images', 'images.imageable_id', 'posts.id')
            ->select(
                'posts.id',
                'posts.title as title',
                'posts.description as description',
                DB::raw('DATE_FORMAT(posts.created_at, "%Y-%m-%d") as created_date'),
                DB::raw('DATE_FORMAT(posts.created_at, "%h:%i:%s") as created_time'),
                'categories.' . $request->lang . '_name as category_name',
                'images.image'
            )
            ->where(['categories.id' => $request->category_id, 'images.imageable_type' => 'App\Models\Post', 'posts.post_type' => $request->lang])
            ->orderBy('posts.id', 'DESC');

        $data = $data->paginate($pageSize);

        $data->appends(['size' => $pageSize])->links();

        $items = [];
        foreach ($data as $row) {
            $items[] = [
                'id' => $row->id,
                'title' => $row->title,
                'description' => $row->description,
                'category_name' => $row->category_name,
                'image' => $row->image,
                'created_date' => $row->created_date,
                'created_time' => $row->created_time,
                'total_records' => count($data)
            ];
        }

        $response = [
            'items' => $items,
            'meta' => [
                'totalItems' => $data->total(),
                'itemCount' => $data->lastItem() - $data->firstItem() + 1,
                'itemsPerPage' => $data->perPage(),
                'totalPages' => $data->lastPage(),
                'currentPage' => $data->currentPage(),
                'first' => $data->url(1),
                'previous' => $data->previousPageUrl(),
                'next' => $data->nextPageUrl(),
                'last' => $data->url($data->lastPage())
            ]
        ];

        return response()->json($response, 200);
    }

    protected function get_week_days(Request $request)
    {
        $data = DayOfWeek::get(['id', $request->lang . '_name as name']);

        return response()->json($data, 200);
    }

    protected function get_day_programs(Request $request)
    {
        $data = DayOfWeekProgram::join('programs', 'programs.id', 'day_of_week_programs.program_id')
            ->join('images', 'images.imageable_id', 'programs.id')
            ->select(
                'programs.id',
                'programs.' . $request->lang . '_title as title',
                'programs.' . $request->lang . '_description as description',
                'programs.' . $request->lang . '_sub_title as sub_title',
                'images.image',
                DB::raw('TIME_FORMAT(start, "%h:%i %p") as start_time'),
                DB::raw('TIME_FORMAT(end, "%h:%i %p") as end_time')
            )
            ->where(['programs.status' => '1', 'images.imageable_type' => 'App\Models\Program', 'day_of_week_programs.day_of_week_id' => $request->day])
            ->get();

        return response()->json($data, 200);
    }

    protected function get_categories(Request $request)
    {
        $data = Category::get(['id', $request->lang . '_name as category_name']);

        return response()->json($data, 200);
    }

    protected function get_search_post(Request $request)
    {
        $pageSize = 10;

        if ($request->has('size')) {
            $pageSize = $request->size;
        }

        $data = Post::join('post_categories', 'post_categories.post_id', 'posts.id')
            ->join('categories', 'categories.id', 'post_categories.category_id')
            ->join('images', 'images.imageable_id', 'posts.id')
            ->select(
                'posts.id',
                'posts.title as title',
                'posts.description as description',
                DB::raw('DATE_FORMAT(posts.created_at, "%Y-%m-%d") as created_date'),
                DB::raw('DATE_FORMAT(posts.created_at, "%h:%i:%s") as created_time'),
                'categories.' . $request->lang . '_name as category_name',
                'images.image'
            )
            ->where('images.imageable_type', 'App\Models\Post')
            ->where('posts.post_type', $request->lang)
            ->where('posts.title', 'LIKE', '%' . $request->searchValue . '%')
            ->orderBy('posts.id', 'DESC');

        $data = $data->paginate($pageSize);

        $data->appends(['size' => $pageSize])->links();

        $items = [];
        foreach ($data as $row) {
            $items[] = [
                'id' => $row->id,
                'title' => $row->title,
                'description' => $row->description,
                'category_name' => $row->category_name,
                'image' => $row->image,
                'created_date' => $row->created_date,
                'created_time' => $row->created_time,
                'total_records' => count($data)
            ];
        }

        $response = [
            'items' => $items,
            'meta' => [
                'totalItems' => $data->total(),
                'itemCount' => $data->lastItem() - $data->firstItem() + 1,
                'itemsPerPage' => $data->perPage(),
                'totalPages' => $data->lastPage(),
                'currentPage' => $data->currentPage(),
                'first' => $data->url(1),
                'previous' => $data->previousPageUrl(),
                'next' => $data->nextPageUrl(),
                'last' => $data->url($data->lastPage())
            ]
        ];

        return response()->json($response, 200);
    }

    protected function get_videos(Request $request)
    {
        $data = Video::orderBy('id', 'DESC')->limit(3)->get(['id', 'url']);

        return response()->json($data, 200);
    }
}
