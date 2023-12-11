@extends('././layouts.master')

@section('content')
  <section class="content">

    <div class="container-fluid">
      <div class="shadow-lg p-3 mb-5 bg-body rounded p-10">
        <h5 class="p-2">
          {{ __('setting.update') }}
        </h5>
        <form action="{{ route('setting.update', ['setting' => $setting->id]) }}" method="post"
          enctype="multipart/form-data" class="col-sm my-auto d-grid gap-3">
          @csrf
          @method('PUT')

          <div class="row">
            <div class="col-sm d-grid gap-3">
              <div class="row">

                <div class="form-group col-sm">
                  <label for="en_nav_title">{{ __('setting.en_nav_title') }}</label>
                  <input type="text" value="{{ $setting->en_nav_title }}" name="en_nav_title"
                    placeholder="{{ __('setting.en_nav_title') }}" class="form-control" />
                  @error('en_nav_title')
                    <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
                <div class="form-group col-sm">
                  <label for="da_nav_title">{{ __('setting.da_nav_title') }}</label>
                  <input type="text" value="{{ $setting->da_nav_title }}" name="da_nav_title"
                    placeholder="{{ __('setting.da_nav_title') }}" class="form-control" />
                  @error('da_nav_title')
                    <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
                <div class="form-group col-sm">
                  <label for="pa_nav_title">{{ __('setting.pa_nav_title') }}</label>
                  <input type="text" value="{{ $setting->pa_nav_title }}" name="pa_nav_title"
                    placeholder="{{ __('setting.pa_nav_title') }}" class="form-control" />
                  @error('pa_nav_title')
                    <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
              </div>

              <div class="form-group">
                <label for="en_nav_subtitle">{{ __('setting.en_nav_subtitle') }}</label>
                <input type="text" name="en_nav_subtitle" value="{{ $setting->en_nav_subtitle }}"
                  placeholder="{{ __('setting.en_nav_subtitle') }}" class="form-control">
                @error('en_nav_subtitle')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
              <div class="form-group">
                <label for="da_nav_subtitle">{{ __('setting.da_nav_subtitle') }}</label>
                <input type="text" name="da_nav_subtitle" value="{{ $setting->da_nav_subtitle }}"
                  placeholder="{{ __('setting.da_nav_subtitle') }}" class="form-control">
                @error('da_nav_subtitle')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
              <div class="form-group">
                <label for="pa_nav_subtitle">{{ __('setting.pa_nav_subtitle') }}</label>
                <input type="text" name="pa_nav_subtitle" value="{{ $setting->pa_nav_subtitle }}"
                  placeholder="{{ __('setting.pa_nav_subtitle') }}" class="form-control">
                @error('pa_nav_subtitle')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>

              <div class="form-group">
                <label for="map_location">{{ __('setting.map_location') }}</label>
                <input type="text" value="{{ $setting->map_location }}" name="map_location"
                  placeholder="{{ __('setting.map_location') }}" class="form-control" />
                @error('map_location')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
              <div class="form-group">
                <label for="phone">{{ __('setting.phone') }}</label>
                <input type="text" value="{{ $setting->phone }}" name="phone"
                  placeholder="{{ __('setting.phone') }}" class="form-control" />
                @error('phone')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>

              <div class="form-group">
                <label for="email">{{ __('setting.email') }}</label>
                <input type="text" value="{{ $setting->email }}" name="email"
                  placeholder="{{ __('setting.email') }}" class="form-control" />
                @error('email')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <div class="col-sm d-grid gap-3">
              <div class="row">
                <div class="form-group col-sm">
                  <label for="en_province">{{ __('setting.en_province') }}</label>
                  <input type="text" value="{{ $setting->en_province }}" name="en_province"
                    placeholder="{{ __('setting.en_province') }}" class="form-control" />
                  @error('en_province')
                    <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
                <div class="form-group col-sm">
                  <label for="da_province">{{ __('setting.da_province') }}</label>
                  <input type="text" value="{{ $setting->da_province }}" name="da_province"
                    placeholder="{{ __('setting.da_province') }}" class="form-control" />
                  @error('da_province')
                    <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
                <div class="form-group col-sm">
                  <label for="pa_province">{{ __('setting.pa_province') }}</label>
                  <input type="text" value="{{ $setting->pa_province }}" name="pa_province"
                    placeholder="{{ __('setting.pa_province') }}" class="form-control" />
                  @error('pa_province')
                    <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
              </div>
              <div class="form-group">
                <label for="en_street">{{ __('setting.en_street') }}</label>
                <input type="text" name="en_street" value="{{ $setting->en_street }}"
                  placeholder="{{ __('setting.en_street') }}" class="form-control">
                @error('en_street')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
              <div class="form-group">
                <label for="da_street">{{ __('setting.da_street') }}</label>
                <input type="text" name="da_street" value="{{ $setting->da_street }}"
                  placeholder="{{ __('setting.da_street') }}" class="form-control">
                @error('da_street')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
              <div class="form-group">
                <label for="pa_street">{{ __('setting.pa_street') }}</label>
                <input type="text" name="pa_street" value="{{ $setting->pa_street }} "
                  placeholder="{{ __('setting.pa_street') }}" class="form-control">
                @error('pa_street')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
              <div class="form-group">
                <label for="en_exact_address">{{ __('setting.en_exact_address') }}</label>
                <input type="text" name="en_exact_address" value="{{ $setting->en_exact_address }}"
                  placeholder="{{ __('setting.en_exact_address') }}" class="form-control">
                @error('en_exact_address')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
              <div class="form-group">
                <label for="da_exact_address">{{ __('setting.da_exact_address') }}</label>
                <input type="text" name="da_exact_address" value="{{ $setting->da_exact_address }}"
                  placeholder="{{ __('setting.da_exact_address') }}" class="form-control">
                @error('da_exact_address')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
              <div class="form-group">
                <label for="pa_exact_address">{{ __('setting.pa_exact_address') }}</label>
                <input type="text" name="pa_exact_address" value="{{ $setting->pa_exact_address }}"
                  placeholder="{{ __('setting.pa_exact_address') }}" class="form-control">
                @error('pa_exact_address')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <div class="col-sm d-grid gap-3">
              <div class="form-group">
                <img class="col-sm" src="{{ asset('storage/all_images/' . $setting->tab_icon) }}" alt="Icon"
                  style="width: 50px; height: 50px;">
              </div>
              <div class="form-group">
                <input type="file" class="form-control" name="tab_icon" />
                @error('image')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
              <div class="form-group">
                <img class="col-sm" src="{{ asset('storage/all_images/' . $setting->nav_logo) }}" alt="Logo"
                  style="width: 50px; height: 50px;">
              </div>
              <div class="form-group">
                <input type="file" class="form-control" name="nav_logo" />
                @error('image')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
            </div>
          </div>
          <hr>
          <div class="col">
            <h2 class="text-center mt-5">
              {{ __('setting.about_us_page') }}
            </h2>
            <div class="form-group">
              <label for="en_about_us">{{ __('setting.en_about_us') }}</label>
              <textarea type="text" name="en_about_us" placeholder="{{ __('setting.en_about_us') }}"
                class="form-control my-editor">{{ $setting->en_about_us }}</textarea>
              @error('en_about_us')
                <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label for="da_about_us">{{ __('setting.da_about_us') }}</label>
              <textarea type="text" name="da_about_us" placeholder="{{ __('setting.da_about_us') }}"
                class="form-control my-editor">{{ $setting->da_about_us }}</textarea>
              @error('da_about_us')
                <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label for="pa_about_us">{{ __('setting.pa_about_us') }}</label>
              <textarea type="text" name="pa_about_us" placeholder="{{ __('setting.pa_about_us') }}"
                class="form-control my-editor">{{ $setting->pa_about_us }}</textarea>
              @error('pa_about_us')
                <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="col-sm-2 col-md-2 m-2 ">
              <button class="btn btn-primary" type="submit">{{ __('setting.save') }}</button>
            </div>
          </div>
        </form>

      </div>
  </section>
@endsection
