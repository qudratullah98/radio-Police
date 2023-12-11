@extends('././layouts.master')

@section('content')
  <section class="content">

    <div class="container-fluid">
      <div class="card p-5">
        <h5 class="card-header">
          {{ __('slider.new_slider') }}
        </h5>
        <div class="card-body">
          <form action="{{ route('slider.store') }}" method="post" enctype="multipart/form-data">
            {{-- <form action="" method="post" enctype="multipart/form-data"> --}}
            @csrf
            <div class="form-group">
              <label for="en_title">{{ __('slider.en_title') }}</label>
              <input type="text" name="en_title" placeholder="{{ __('slider.en_title') }}" class="form-control" />
              @error('en_title')
                <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label for="da_title">{{ __('slider.da_title') }}</label>
              <input type="text" name="da_title" placeholder="{{ __('slider.da_title') }}" class="form-control" />
              @error('da_title')
                <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label for="pa_title">{{ __('slider.pa_title') }}</label>
              <input type="text" name="pa_title" placeholder="{{ __('slider.pa_title') }}" class="form-control" />
              @error('pa_title')
                <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label for="image">{{ __('category.image') }}</label>
              <input type="file" class="form-control" name="image" />
              @error('image')
                <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group p-3">
              <input type="checkbox" value="1" name="status"class="form-check-input" />
              @error('status')
                <p class="text-danger">{{ $message }}</p>
              @enderror
              <label class="form-check-labe" for="status">{{ __('category.status') }}</label>
            </div>
            <button class="btn btn-primary" type="submit">{{ __('category.save') }}</button>

          </form>

        </div>
      </div>
  </section>
@endsection
