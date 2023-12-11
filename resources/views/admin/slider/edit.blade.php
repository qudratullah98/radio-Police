@extends('././layouts.master')

@section('content')
  <section class="content">

    <div class="container-fluid">
      <div class="shadow-lg p-3 mb-5 bg-body rounded p-10">
        <h5 class="p-2">
          {{ __('slider.update') }}
        </h5>
        <div class="row">
          <form action="{{ route('slider.update', ['slider' => $slider->id]) }}" method="post" enctype="multipart/form-data"
            class="col-sm my-auto d-grid gap-3">
            @csrf
            @method('PUT')
            <div class="form-group ">
              <label for="en_title">{{ __('slider.en_title') }}
              </label>
              <input type="text" value="{{ $slider->en_title }}" name="en_title"
                placeholder="{{ __('slider.en_title') }}" class="form-control" />
              @error('en_title')
                <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label for="da_title">{{ __('slider.da_title') }}
              </label>
              <input type="text" value="{{ $slider->da_title }}" name="da_title"
                placeholder="{{ __('slider.da_title') }}" class="form-control" />
              @error('da_title')
                <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label for="pa_title">{{ __('slider.pa_title') }}
              </label>
              <input type="text" value="{{ $slider->pa_title }}" name="pa_title"
                placeholder="{{ __('slider.pa_title') }}" class="form-control" />
              @error('pa_title')
                <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label for="pa_title">{{ __('category.image') }}
              </label>

              <input type="file" name="image" placeholder="Image" class="form-control" />
              @error('image')
                <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group p-3">

              <input type="checkbox"
                @if ($slider->status) checked value="{{ $slider->status }}" @else value="1" name="status" @endif
                class="form-check-input" />
              @error('status')
                <p class="text-danger">{{ $message }}</p>
              @enderror
              <label class="form-check-labe" for="status">{{ __('category.status') }}</label>
            </div>
            <button class="btn btn-primary " type="submit">{{ __('category.update') }}</button>


          </form>
          <img class="col-sm" src="{{ asset('storage/all_images/' . $file->image) }}" alt="image"
            style="width: 100%; height: 100%;">

        </div>
      </div>
  </section>
@endsection
