@extends('././layouts.master')

@section('content')
  <section class="content">

    <div class="container-fluid">
      <div class="shadow-lg p-3 mb-5 bg-body rounded p-10">
        <h5 class="p-2">
          {{ __('program.program') }}
        </h5>
        <form action="{{ route('program.store') }}" method="post" enctype="multipart/form-data"
          class="col-sm my-auto d-grid gap-3">
          @csrf
          <div class="row">
            <div class="col-sm d-grid gap-3">
              <div class="form-group">
                <label for="en_title">{{ __('program.en_title') }}</label>
                <input type="text" name="en_title" placeholder="{{ __('program.en_title') }}" class="form-control" />
                @error('en_title')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
              <div class="form-group">
                <label for="da_title">{{ __('program.da_title') }}</label>
                <input type="text" name="da_title" placeholder="{{ __('program.da_title') }}" class="form-control" />
                @error('da_title')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
              <div class="form-group">
                <label for="pa_title">{{ __('program.pa_title') }}</label>
                <input type="text" name="pa_title" placeholder="{{ __('program.pa_title') }}" class="form-control" />
                @error('pa_title')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>

              <div class="form-group">
                <label for="en_sub_title">{{ __('program.en_sub_title') }}</label>
                <input type="text" class="form-control" name="en_sub_title"
                  placeholder="{{ __('program.en_sub_title') }}" />
                @error('en_sub_title')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>

              <div class="form-group p-3 row">
                <div class="col-sm-2 col-md-2 ">
                  <button class="btn btn-primary" type="submit">{{ __('program.save') }}</button>
                </div>
                <div class="col-sm-2 col-md-2 mt-2 mx-auto ">
                  <input type="checkbox" value="1" name="status"class="form-check-input" />
                  @error('status')
                    <p class="text-danger">{{ $message }}</p>
                  @enderror
                  <label class="form-check-labe" for="status">{{ __('program.status') }}</label>
                </div>
              </div>

            </div>
            <div class="col-sm d-grid gap-3">
              <div class="form-group">
                <label for="da_sub_title">{{ __('program.da_sub_title') }}</label>
                <input type="text" name="da_sub_title" placeholder="{{ __('program.da_sub_title') }}"
                  class="form-control" />
                @error('da_sub_title')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
              <div class="form-group">
                <label for="pa_sub_title">{{ __('program.pa_sub_title') }}</label>
                <input type="text" name="pa_sub_title"class="form-control"
                  placeholder="{{ __('program.pa_sub_title') }}" />
                @error('pa_sub_title')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>

              <div class="form-group">
                <label for="en_description">{{ __('program.en_description') }}</label>
                <input type="text" class="form-control" name="en_description"
                  placeholder="{{ __('program.en_description') }}" />
                @error('en_description')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
              <div class="form-group">
                <label for="da_description">{{ __('program.da_description') }}</label>
                <input type="text" class="form-control" name="da_description"
                  placeholder="{{ __('program.da_description') }}" />
                @error('da_description')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
            </div>

            <div class="col-sm d-grid gap-3">
              <div class="form-group">
                <label for="pa_description">{{ __('program.pa_description') }}</label>
                <input type="text" class="form-control" name="pa_description"
                  placeholder="{{ __('program.pa_description') }}" />
                @error('pa_description')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
              <div class="row gap-3">
                <div class="form-group col-sm">
                  <label for="start">{{ __('program.start') }}</label>
                  <input type="time" name="start" class="form-control" />
                  @error('start')
                    <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
                <div class="form-group col-sm">
                  <label for="end">{{ __('program.end') }}</label>
                  <input type="time" name="end" class="form-control" />
                  @error('end')
                    <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
              </div>
              <div class="form-group">
                <label for="image">{{ __('program.image') }}</label>
                <input type="file" class="form-control" name="image" />
                @error('image')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>

              <div class="col mt-10">
                @error('day_of_week')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
                @foreach ($day_of_weeks as $index => $day_of_week)
                  <tr key={$index} class="col-sm">
                    <span class="px-2">
                      <input type="checkbox" value="{{ $day_of_week->id }}"
                        name="day_of_week[]"class="form-check-input" />
                      <label class=" form-check-labe" for="day_of_week[]">{{ $day_of_week->en_name }}</label>
                    </span>

                  </tr>
                @endforeach
              </div>
            </div>
          </div>

          <hr>
          {{-- <div class="col mt-5">
                    @foreach ($tags as $index => $tag)
                        <tr key={$index} class="col-sm">
                            <span class="px-2">
                                <input type="checkbox" value="{{ $tag->id }}"
                                    name="tag[]"class="form-check-input" />
                                <label class=" form-check-labe" for="tag[]">{{ $tag->en_name }}</label>
                            </span>

                        </tr>
                    @endforeach
                </div> --}}

        </form>

      </div>
  </section>
@endsection
