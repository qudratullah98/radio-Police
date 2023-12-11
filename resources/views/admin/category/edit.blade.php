@extends('././layouts.master')

@section('content')
  <section class="content">

    <div class="container-fluid">
      <div class="card p-5">
        <h5 class="card-header">
          {{ __('category.update') }}
        </h5>
        <div class="card-body">
          <form action="{{ route('category.update', ['category' => $category->id]) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="en_name">{{ __('category.en_name') }}</label>
                  <input type="text" value="{{ $category->en_name }}" name="en_name" placeholder="E-Name"
                    class="form-control" />
                  @error('en_name')
                    <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
                <div class="form-group pt-3">
                  <button class="btn btn-primary " type="submit">{{ __('category.update') }}</button>

                  @if ($category->main_menu)
                    <input type="checkbox" value="{{ $category->main_menu }}" checked name="main_menu"
                      class="form-check-input" />
                  @else
                    <input type="checkbox" value="1" name="main_menu" class="form-check-input" />
                  @endif
                  @error('main_menu')
                    <p class="text-danger">{{ $message }}</p>
                  @enderror
                  <label class="form-check-labe" for="status">{{ __('category.main_menu') }}</label>
                  @if ($category->status)
                    <input type="checkbox" value="{{ $category->status }}" checked name="status"
                      class="form-check-input" />
                  @else
                    <input type="checkbox" value="1" name="status"class="form-check-input" />
                  @endif
                  @error('status')
                    <p class="text-danger">{{ $message }}</p>
                  @enderror
                  <label class="form-check-labe" for="status">{{ __('category.status') }}</label>
                </div>

              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="da_name">{{ __('category.da_name') }}</label>
                  <input type="text" value="{{ $category->da_name }}" name="da_name" placeholder="D-Name"
                    class="form-control" />
                  @error('da_name')
                    <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="pa_name">{{ __('category.pa_name') }}</label>
                  <input type="text" value="{{ $category->pa_name }}" name="pa_name" placeholder="P-Name"
                    class="form-control" />
                  @error('pa_name')
                    <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>

              </div>

          </form>

        </div>
      </div>
  </section>
@endsection
