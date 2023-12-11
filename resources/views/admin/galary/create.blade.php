@extends('././layouts.master')

@section('content')
  <section class="content">

    <div class="container-fluid">
      <div class="card p-5">
        <h5 class="card-header">
          {{ __('galary.new_galary') }}
        </h5>
        <div class="card-body">
          <form action="{{ route('galary.store') }}" method="post" enctype="multipart/form-data">
            {{-- <form action="" method="post" enctype="multipart/form-data"> --}}
            @csrf
            <div class="form-group">
              <label for="en_title">{{ __('galary.en_title') }}</label>
              <input type="text" name="en_title" placeholder="{{ __('galary.en_title') }}" class="form-control" />
              @error('en_title')
                <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label for="da_title">{{ __('galary.da_title') }}</label>
              <input type="text" name="da_title" placeholder="{{ __('galary.da_title') }}" class="form-control" />
              @error('da_title')
                <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label for="pa_title">{{ __('galary.pa_title') }}</label>
              <input type="text" name="pa_title" placeholder="{{ __('galary.pa_title') }}" class="form-control" />
              @error('pa_title')
                <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label for="image">{{ __('galary.image') }}</label>
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
              <label class="form-check-labe" for="status">{{ __('galary.status') }}</label>
            </div>
            <button class="btn btn-primary" type="submit">{{ __('galary.save') }}</button>

          </form>

        </div>
      </div>
  </section>
@endsection
