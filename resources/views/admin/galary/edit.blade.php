@extends('././layouts.master')

@section('content')
  <section class="content">

    <div class="container-fluid">
      <div class="shadow-lg p-3 mb-5 bg-body rounded p-10">
        <h5 class="p-2">
          {{ __('galary.update') }}
        </h5>
        <div class="row">
          <form action="{{ route('galary.update', ['galary' => $galary->id]) }}" method="post" enctype="multipart/form-data"
            class="col-sm my-auto d-grid gap-3">
            @csrf
            @method('PUT')
            <div class="form-group ">
              <label for="en_title">{{ __('galary.en_title') }}</label>
              <input type="text" value="{{ $galary->en_title }}" name="en_title"
                placeholder="{{ __('galary.en_title') }}" class="form-control" />
              @error('en_title')
                <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label for="da_title">{{ __('galary.da_title') }}</label>
              <input type="text" value="{{ $galary->da_title }}" name="da_title"
                placeholder="{{ __('galary.da_title') }}" class="form-control" />
              @error('da_title')
                <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label for="pa_title">{{ __('galary.pa_title') }}</label>
              <input type="text" value="{{ $galary->pa_title }}" name="pa_title"
                placeholder="{{ __('galary.pa_title') }}" class="form-control" />
              @error('pa_title')
                <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <input type="file" name="image" placeholder="Image" class="form-control" />
              @error('image')
                <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group p-3">
              <input type="checkbox"
                @if ($galary->status) checked value="{{ $galary->status }}" @else value="1" name="status" @endif
                class="form-check-input" />
              @error('status')
                <p class="text-danger">{{ $message }}</p>
              @enderror
              <label class="form-check-labe" for="status">{{ __('galary.status') }}</label>
            </div>
            <button class="btn btn-primary " type="submit">{{ __('galary.update') }}</button>

          </form>
          <img class="col-sm" src="{{ asset('storage/all_images/' . $file->image) }}" alt="image"
            style="width: 100%; height: 100%;">

        </div>
      </div>
  </section>
@endsection
