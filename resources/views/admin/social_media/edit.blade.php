@extends('././layouts.master')

@section('content')
  <section class="content">

    <div class="container-fluid">
      <div class="shadow-lg p-3 mb-5 bg-body rounded p-10">
        <h5 class="p-2">
          {{ __('socialMedia.update') }}

        </h5>
        <form action="{{ route('social_media.update', ['social_media' => $social_media->id]) }}" method="post"
          enctype="multipart/form-data" class="col-sm my-auto d-grid gap-3">
          @csrf
          @method('PUT')
          <div class="row">
            <div class="col-sm d-grid gap-3">
              <div class="form-group">
                <label for="en_title">{{ __('socialMedia.en_title') }}</label>
                <input type="text" value="{{ $social_media->en_title }}" name="en_title"
                  placeholder="{{ __('socialMedia.en_title') }}" class="form-control" />
                @error('en_title')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
              <div class="form-group">
                <label for="da_title">{{ __('socialMedia.da_title') }}</label>
                <input type="text" value="{{ $social_media->da_title }}" name="da_title"
                  placeholder="{{ __('socialMedia.da_title') }}" class="form-control" />
                @error('da_title')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>

              <div class="form-group">
                <label for="pa_title">{{ __('socialMedia.pa_title') }}</label>
                <input type="text" value="{{ $social_media->pa_title }}" name="pa_title"
                  placeholder="{{ __('socialMedia.pa_title') }}" class="form-control" />
                @error('pa_title')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
              <div class="form-group">
                <label for="url">{{ __('socialMedia.pa_title') }}</label>
                <input type="text" value="{{ $social_media->url }}" name="url"
                  placeholder="{{ __('socialMedia.pa_title') }}" class="form-control" />
                @error('url')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
              <div class="form-group row">

                <div class="col-sm">
                  <div class="row">
                    <div class="col-sm">
                      <label for="icon">{{ __('socialMedia.icon') }}</label>
                      <input type="file" class="form-control" name="socialMediaIcon"
                        value="{{ $social_media->socialMediaIcon }}" />
                      @error('icon')
                        <p class="text-danger">{{ $message }}</p>
                      @enderror
                      <div class="form-group p-3 row gap-10">
                        <div class="col-sm-2 col-sm ">
                          <button class="btn btn-primary" type="submit">{{ __('socialMedia.update') }}</button>
                        </div>
                        <div class="col-sm-2 col-sm mt-2">
                          <input type="checkbox"
                            @if ($social_media->status) checked value="{{ $social_media->status }}" @else value="1" name="status" @endif
                            class="form-check-input" />
                          @error('status')
                            <p class="text-danger">{{ $message }}</p>
                          @enderror
                          <label class="form-check-labe" for="status">{{ __('socialMedia.status') }}</label>
                        </div>
                      </div>

                    </div>
                    <div class="col-sm">
                      <img class="col-sm mt-5" src="{{ asset('storage/all_images/' . $social_media->socialMediaIcon) }}"
                        alt="image" style="width: 50px; height: 50px;">
                    </div>
                  </div>

                </div>

              </div>

            </div>
            <div class="col-sm d-grid gap-3">

              <img class="col-sm" src="{{ asset('storage/all_images/' . $social_media->backgroundImage) }}"
                alt="image" style="width: 100%; height: 100%;">
              <div class="col-sm">
                <label for="image">{{ __('socialMedia.image') }}</label>
                <input type="file" class="form-control" name="backgroundImage"
                  value="{{ $social_media->backgroundImage }}" />
                @error('image')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
            </div>
          </div>
          <hr>
        </form>

      </div>
  </section>
@endsection
