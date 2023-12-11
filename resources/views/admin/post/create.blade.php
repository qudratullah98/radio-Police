@extends('././layouts.master')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="shadow-lg p-3 mb-5 bg-body rounded p-10">
                <h5 class="p-2">
                    {{ __('post.new_post') }}
                </h5>
                <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data" class="col-sm my-auto d-grid gap-3" autocomplete="off">
                    @csrf
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group col-4">
                                <label for="title">{{ __('post.title') }}</label>
                                <input type="text" name="title" placeholder="{{ __('post.title') }}" class="form-control" value="{{ old('title') }}" />
                                @error('title')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-4">
                                <label for="sub_title">{{ __('post.sub_title') }}</label>
                                <input type="text" name="sub_title" placeholder="{{ __('post.sub_title') }}" class="form-control" value="{{ old('sub_title') }}" />
                                @error('sub_title')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-4">
                                <label for="post_type">نوعیت نشرات</label>
                                <select name="post_type" class="form-control">
                                    <option value="">انتخاب نوعیت نشرات</option>
                                    <option value="en" {{ old('post_type') == 'en' ? 'selected' : '' }}>انگلیسی</option>
                                    <option value="da" {{ old('post_type') == 'da' ? 'selected' : '' }}>دری</option>
                                    <option value="pa" {{ old('post_type') == 'pa' ? 'selected' : '' }}>پشتو</option>
                                </select>
                                @error('post_type')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">{{ __('post.description') }}</label>
                        <textarea type="text" name="description" placeholder="{{ __('post.description') }}" class="form-control">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col mt-10">
                        @foreach ($categories as $index => $category)
                            <tr key={$index} class="col-sm">
                                <span class="px-2">
                                    <input type="checkbox" value="{{ $category->id }}" name="category[]"class="form-check-input" />
                                    <label class="form-check-labe" for="category[]">{{ $category->da_name }}</label>
                                </span>
                            </tr>
                        @endforeach
                        <br>
                        @error('category')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <hr>
                    <div class="form-group p-3 row">
                        <div class="col-sm-2 col-md-2 ">
                            <button class="btn btn-primary" type="submit">{{ __('post.save') }}</button>
                        </div>
                        <div class="col-sm-2 col-md-2 mt-2 mr-10 ">
                            <input type="checkbox" value="1" checked name="status"class="form-check-input" />
                            @error('status')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <label class="form-check-labe" for="status">{{ __('post.status') }}</label>
                        </div>
                        <div class="col-sm-4 col-md-4 mr-10">
                            <label for="image">{{ __('post.image') }}</label>
                            <input type="file" class="form-control" name="image" />
                            @error('image')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </form>
            </div>
    </section>
@endsection
