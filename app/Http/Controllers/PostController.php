<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostMeta;
use App\Models\PostTag;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Post::with('categories')->orderby('id', 'desc');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('post_type', function ($data) {
                    if ($data->post_type == 'en') {
                        $span = '<span class="badge badge-primary">English</span>';
                    } else if ($data->post_type == 'da') {
                        $span = '<span class="badge badge-info">Dari</span>';
                    } else {
                        $span = '<span class="badge badge-warning">Pashto</span>';
                    }
                    return $span;
                })
                ->addColumn('categories', function ($data) {
                    $value = '';
                    foreach ($data->categories as $row) {
                        $value .= '<span class="badge badge-dark m-1">' . $row->pa_name . '</span>';
                    }
                    return $value;
                })
                // ->addColumn('status', function ($data) {
                //     return $data->status ? ' <input class="form-check-input" type="radio" checked disabled>' : '<input class="form-check-input" type="radio" disabled>';
                // })
                ->addColumn('creation_date', function ($data) {
                    return date("Y-m-d", strtotime($data->created_at));
                })
                ->addColumn('action', function ($data) {
                    return '<a href="javascript:void(0)" class="btn btn-light-danger btn-sm delete fa fa-trash" id="' . $data->id . '"></a>
                    &nbsp; | &nbsp;
                    <a href="' . route('post.edit', ['post' => $data->id]) . '" class="btn btn-light-primary btn-sm fa fa-edit"></a>';
                })
                ->escapeColumns([])
                // ->rawColumns(['status'])
                ->rawColumns(['creation_date'])
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.post.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected function create()
    {
        $categories = Category::all();
        // $tags = Tag::all();
        return view('admin.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|max:300',
                'sub_title' => 'max:600',
                'description' => 'required',
                'category' => 'required|array',
                'post_type' => 'required',
                'image'  => ['required', 'mimes:png,jpg,jpeg,pdf', 'max:2000']
            ],
            [
                'title.required' => 'عنوان ضروری است',
                // 'sub_title.required' => 'عنوان فرعی ضروری است',
                'description.required' => 'جزیات ضروری است',
                'category.required' => 'کتگوری ضروری است',
                'post_type.required' => 'نوعیت نشرات ضروری است',
                'image.required' => 'عکس ضروری است'
            ]
        );

        DB::beginTransaction();
        try {
            $post = new Post();
            $post->title = $request->title;
            $post->sub_title = $request->sub_title;
            $post->description = $request->description;
            $post->status = $request->status;
            $post->post_type = $request->post_type;
            $post->created_by = Auth::user()->id;
            $post->save();

            $image = Storage::disk('all_images')->put(date('Y') . '/' . date('m') . '/' . date('d'), $request->file('image'));
            $post->images()->create(['image' => $image]);

            foreach ($request->category as $category) {
                PostCategory::create(['post_id' => $post->id, 'category_id' => $category]);
            }

            DB::commit();
            Session::flash('success', 'Created Successfuly');
            return redirect('post');
        } catch (Throwable $e) {
            dd($e);
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    protected function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    protected function edit(Post $post)
    {
        try {
            $categories = Category::all();
            $post_categories = DB::table('post_categories')->where('post_id', $post->id)->get();
            $file = Image::where(['imageable_id' => $post->id, 'images.imageable_type' => 'App\Models\Post'])->first();

            return view('admin.post.edit', compact('post', 'categories', 'post_categories', 'file'));
        } catch (Throwable $e) {
            dd($e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    protected function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:300',
            'sub_title' => 'required|max:600',
            'description' => 'required',
            'category' => 'required|array',
            'post_type' => 'required'
        ]);

        DB::beginTransaction();
        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image = Storage::disk('all_images')->put(date('Y') . '/' . date('m') . '/' . date('d'), $request->file('image'));
                $post->images()->update(['image' => $image]);
            }

            $post->title = $request->title;
            $post->sub_title = $request->sub_title;
            $post->description = $request->description;
            $post->status = $request->status;
            $post->post_type = $request->post_type;
            $post->updated_by = Auth::user()->id;
            $post->save();

            $post->categories()->sync($request->category);
            // $post->tags()->sync($request->tag);
            DB::commit();
            Session::flash('success', 'Updated Successfuly');
            return redirect('post');
        } catch (Throwable $e) {
            dd($e);
            DB::rollback();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    protected function destroy($id)
    {
        DB::beginTransaction();
        try {
            Post::findOrFail($id)->delete();
            DB::commit();
            Session::flash('success', 'Deleted Successfuly');
            return true;
        } catch (Throwable $e) {
            DB::rollback();
            dd($e);
        }
    }

    protected function trash()
    {
        return view('admin.post.trash')->with('posts', Post::onlyTrashed()->paginate(10));
    }
    protected function delete($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();
        $post->forceDelete();
        return 'success';
    }

    protected function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();
        $post->restore();
        return redirect()->route('post.index');
    }
}
