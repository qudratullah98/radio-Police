@extends('././layouts.master')


@section('content')
  <section class="content">

    <div class="container-fluid">
      <div class="card p-5">
        <h5 class="card-header">پست جدید
        </h5>
        <div class="card-body">
          <form action="{{ route('tag.update', ['tag' => $tag->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="en_name">E-Name</label>
              <input type="text" value="{{ $tag->en_name }}" name="en_name" placeholder="E-Name"
                class="form-control" />
              @error('en_name')
                <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label for="da_name">D-Name</label>
              <input type="text" value="{{ $tag->da_name }}" name="da_name" placeholder="D-Name"
                class="form-control" />
              @error('da_name')
                <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label for="pa_name">P-Name</label>
              <input type="text" value="{{ $tag->pa_name }}" name="pa_name" placeholder="P-Name"
                class="form-control" />
              @error('pa_name')
                <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group p-3">
              <input type="checkbox"
                @if ($tag->status) checked value="{{ $tag->status }}" @else value="1" name="status" @endif
                class="form-check-input" />
              @error('status')
                <p class="text-danger">{{ $message }}</p>
              @enderror
              <label class="form-check-labe" for="status">Status</label>
            </div>
            <button class="btn btn-primary " type="submit">ثبت</button>

          </form>

        </div>
      </div>
  </section>
@endsection
