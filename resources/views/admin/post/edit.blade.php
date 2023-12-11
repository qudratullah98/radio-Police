@extends('././layouts.master')

@section('content')
    <section class="content">
        <div class="shadow-lg p-10 mb-5 bg-body rounded p-1">
            <div class="d-flex justify-content-between">
                <h5 class="p-2">
                    {{ __('post.update') }}
                </h5>
                <a href="{{ route('post.index') }}" class="btn btn-linkedin">{{ trans('post.back') }}</a>
            </div>
            <form action="{{ route('post.update', ['post' => $post->id]) }}" method="post" enctype="multipart/form-data" class="col-sm my-auto d-grid gap-3">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="form-group col-4">
                        <label for="title">{{ __('post.title') }}</label>
                        <input type="text" value="{{ $post->title }}" name="title" placeholder="{{ __('post.title') }}" class="form-control" />
                        @error('title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-4">
                        <label for="sub_title">{{ __('post.sub_title') }}</label>
                        <input type="text" name="sub_title" value="{{ $post->sub_title }}" placeholder="{{ __('post.sub_title') }}" class="form-control" />
                        @error('en_sub_title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-4">
                        <label for="post_type">نوعیت نشرات</label>
                        <select name="post_type" class="form-control">
                            <option value="">انتخاب نوعیت نشرات</option>
                            <option value="en" {{ $post->post_type == 'en' ? 'selected' : '' }}>انگلیسی</option>
                            <option value="da" {{ $post->post_type == 'da' ? 'selected' : '' }}>دری</option>
                            <option value="pa" {{ $post->post_type == 'pa' ? 'selected' : '' }}>پشتو</option>
                        </select>
                        @error('post_type')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-12">
                        <label for="description">{{ __('post.description') }}</label>
                        <textarea type="text" name="description" placeholder="{{ __('post.description') }}" rows="10" class="form-control">{{ $post->description }}</textarea>
                        @error('en_description')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="row mt-10">
                        <div class="form-group col-6">
                            <input type="file" class="form-control" name="image" />
                            @error('image')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-6">
                            <img class="col-sm" src="{{ asset('storage/all_images/' . $file->image) }}" alt="image" style="max-width: 30%;">
                        </div>
                    </div>
                </div>

                <div class="col mt-10">
                    @error('category')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    @foreach ($categories as $index => $category)
                        <tr key={$index} class="col-sm">
                            <span class="px-2">
                                <input type="checkbox" value="{{ $category->id }}" @foreach ($post_categories as $post_category)
                                    @if ($category->id == $post_category->category_id)
                                    checked
                                    @endif @endforeach name="category[]" class="form-check-input" />
                                <label class=" form-check-labe" for="category[]">{{ $category->da_name }}</label>
                            </span>
                        </tr>
                    @endforeach
                </div>
                <hr>
                <div class="form-group p-3 row">
                    <div class="col-sm-2 col-md-2 ">
                        <button class="btn btn-primary btn-sm" type="submit">{{ __('post.update') }}</button>
                    </div>
                    <div class="col-sm-2 col-md-2 mt-2 ">
                        <input type="checkbox" @if ($post->status) checked value="{{ $post->status }}" @else value="1" name="status" @endif class="form-check-input" />
                        @error('status')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <label class="form-check-labe" for="status">{{ __('post.status') }}</label>
                    </div>
                </div>
            </form>
    </section>
@endsection
