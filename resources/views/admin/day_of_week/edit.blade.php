@extends('././layouts.master')

@section('content')
  <section class="content">

    <div class="container-fluid">
      <div class="card p-5">
        <h5 class="card-header">
          {{ __('day_of_week.update') }}
        </h5>
        <div class="card-body">
          <form action="{{ route('day_of_week.update', ['day_of_week' => $day_of_week->id]) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="en_name">{{ __('day_of_week.en_name') }}</label>
              <input type="text" value="{{ $day_of_week->en_name }}" name="en_name"
                placeholder="{{ __('day_of_week.en_name') }}" class="form-control" />
              @error('en_name')
                <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label for="da_name">{{ __('day_of_week.da_name') }}</label>
              <input type="text" value="{{ $day_of_week->da_name }}" name="da_name"
                placeholder="{{ __('day_of_week.da_name') }}" class="form-control" />
              @error('da_name')
                <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label for="pa_name">{{ __('day_of_week.pa_name') }}</label>
              <input type="text" value="{{ $day_of_week->pa_name }}" name="pa_name"
                placeholder="{{ __('day_of_week.pa_name') }}" class="form-control" />
              @error('pa_name')
                <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group p-3">
              @if ($day_of_week->status)
                <input type="checkbox" value="{{ $day_of_week->status }}" checked name="status"
                  class="form-check-input" />
              @else
                <input type="checkbox" value="1" name="status"class="form-check-input" />
              @endif
              @error('status')
                <p class="text-danger">{{ $message }}</p>
              @enderror
              <label class="form-check-labe" for="status">{{ __('day_of_week.status') }}</label>
            </div>
            <button class="btn btn-primary " type="submit">{{ __('day_of_week.update') }}</button>

          </form>

        </div>
      </div>
  </section>
@endsection
