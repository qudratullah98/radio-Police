@extends('././layouts.master')

@section('content')
  <section class="content">

    <div class="container-fluid">
      <div class="shadow-lg p-3 mb-5 bg-body rounded p-10">
        <h5 class="p-2">
          {{ __('video.video') }}
        </h5>
        <form action="{{ route('video.store') }}" method="post" enctype="multipart/form-data"
          class="col-sm my-auto d-grid gap-3">
          @csrf
          <div class="row">
            <div class="col-sm d-grid gap-3">
              <div class="form-group">
                <label for="en_title">{{ __('video.en_title') }}</label>
                <input type="text" name="en_title" placeholder="{{ __('video.en_title') }}" class="form-control" />
                @error('en_title')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>

              <div class="form-group">
                <label for="da_title">{{ __('video.da_title') }}</label>
                <input type="text" name="da_title" placeholder="{{ __('video.da_title') }}" class="form-control" />
                @error('da_title')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>



              <div class="form-group p-3 row">
                <div class="col-sm-2 col-md-2 ">
                  <button class="btn btn-primary" type="submit">{{ __('video.save') }}</button>
                </div>
                <div class="col-sm-2 col-md-2 mt-2 mx-auto ">
                  <input type="checkbox" value="1" name="status"class="form-check-input" />
                  @error('status')
                    <p class="text-danger">{{ $message }}</p>
                  @enderror
                  <label class="form-check-labe" for="status">{{ __('video.status') }}</label>
                </div>
              </div>

            </div>


            <div class="col-sm">


              <div class="form-group">
                <label for="pa_title">{{ __('video.pa_title') }}</label>
                <input type="text" name="pa_title" placeholder="{{ __('video.pa_title') }}" class="form-control" />
                @error('pa_title')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>

              <div class="form-group mt-3">
                <label for="url">{{ __('video.url') }}</label>
                <input type="text" name="url" placeholder="{{ __('video.url') }}" class="form-control" />
                @error('url')
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
