@extends('././layouts.master')

@section('content')
  <section class="content">

    <div class="container-fluid">
      <div class="shadow-lg p-3 mb-5 bg-body rounded p-10">
        <h5 class="p-2">
          {{ __('socialMedia.newSocialMedia') }}
        </h5>
        <form action="{{ route('social_media.store') }}" method="post" enctype="multipart/form-data"
          class="col-sm my-auto d-grid gap-3">
          @csrf
          <div class="row">
            <div class="col-sm d-grid gap-3">
              <div class="form-group">
                <label for="en_title">{{ __('socialMedia.en_title') }}</label>
                <input type="text" name="en_title" placeholder="{{ __('socialMedia.en_title') }}"
                  class="form-control" />
                @error('en_title')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
              <div class="form-group">
                <label for="da_title">{{ __('socialMedia.da_title') }}</label>
                <input type="text" name="da_title" placeholder="{{ __('socialMedia.da_title') }}"
                  class="form-control" />
                @error('da_title')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
              <div class="form-group p-3 row">
                <div class="col-sm-2 col-md-2 ">
                  <button class="btn btn-primary" type="submit">{{ __('socialMedia.save') }}</button>
                </div>
                <div class="col-sm-2 col-md-2 mt-2 mr-10 ">
                  <input type="checkbox" value="1" name="status"class="form-check-input" />
                  @error('status')
                    <p class="text-danger">{{ $message }}</p>
                  @enderror
                  <label class="form-check-labe" for="status">{{ __('socialMedia.status') }}</label>
                </div>
              </div>
            </div>
            <div class="col-sm d-grid gap-3">
              <div class="form-group">
                <label for="pa_title">{{ __('socialMedia.pa_title') }}</label>
                <input type="text" name="pa_title" placeholder="{{ __('socialMedia.pa_title') }}"
                  class="form-control" />
                @error('pa_title')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
              <div class="form-group">
                <label for="url">{{ __('socialMedia.url') }}</label>
                <input type="text" name="url" placeholder="{{ __('socialMedia.url') }}" class="form-control" />
                @error('url')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
              <div class="form-group row">
                <div class="col-sm">
                  <label for="backgroundImage">{{ __('socialMedia.image') }}</label>
                  <input type="file" class="form-control" name="backgroundImage" />
                  @error('backgroundImage')
                    <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
                <div class="col-sm">
                  <label for="socialMediaIcon">{{ __('socialMedia.icon') }}</label>
                  <input type="file" class="form-control" name="socialMediaIcon" />
                  @error('socialMediaIcon')
                    <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>
          </div>
          <hr>
        </form>
      </div>
  </section>
@endsection
