@extends('././layouts.master')


@section('content')
  <section class="content">

    <div class="container-fluid">
      <div class="card p-5">
        <h5 class="card-header">
          {{ __('category.new_category') }}
        </h5>
        <div class="card-body">
          <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
            {{-- <form action="" method="post" enctype="multipart/form-data"> --}}
            @csrf
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="en_name">{{ __('category.en_name') }}</label>
                  <input type="text" name="en_name" placeholder="{{ __('category.en_name') }}" class="form-control" />
                  @error('en_name')
                    <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>


                <div class="form-group p-3">
                  <button class="btn btn-primary" type="submit">{{ __('category.save') }}</button>

                  <input type="checkbox" value="1" name="main_menu" class="form-check-input" />
                  @error('main_menu')
                    <p class="text-danger">{{ $message }}</p>
                  @enderror
                  <label class="form-check-labe" for="main_menu">{{ __('category.main_menu') }}</label>
                  <input type="checkbox" value="1" name="status"class="form-check-input" />
                  @error('status')
                    <p class="text-danger">{{ $message }}</p>
                  @enderror
                  <label class="form-check-labe" for="status">{{ __('category.status') }}</label>
                </div>


              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="pa_name">{{ __('category.pa_name') }}</label>
                  <input type="text" name="pa_name" placeholder="{{ __('category.pa_name') }}" class="form-control" />
                  @error('pa_name')
                    <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="da_name">{{ __('category.da_name') }}</label>
                  <input type="text" name="da_name" placeholder="{{ __('category.da_name') }}" class="form-control" />
                  @error('da_name')
                    <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>

              </div>
            </div>


          </form>

        </div>
      </div>
  </section>
@endsection
