@extends('././layouts.master')

@section('content')
  <section class="content">

    <div class="container-fluid">
      <div class="card p-5">
        <h5 class="card-header">

          برچسپ جدید
        </h5>
        <div class="card-body">
          <form action="{{ route('tag.store') }}" method="post" enctype="multipart/form-data">
            {{-- <form action="" method="post" enctype="multipart/form-data"> --}}
            @csrf
            <div class="form-group">
              <label for="en_name">E-Name</label>
              <input type="text" name="en_name" placeholder="E-Name" class="form-control" />
              @error('en_name')
                <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label for="da_name">D-Name</label>
              <input type="text" name="da_name" placeholder="D-Name" class="form-control" />
              @error('da_name')
                <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label for="pa_name">P-Name</label>
              <input type="text" name="pa_name" placeholder="P-Name" class="form-control" />
              @error('pa_name')
                <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group p-3">
              <input type="checkbox" value="1" name="status"class="form-check-input" />
              @error('status')
                <p class="text-danger">{{ $message }}</p>
              @enderror
              <label class="form-check-labe" for="status">Status</label>
            </div>
            <button class="btn btn-primary" type="submit">ثبت</button>

          </form>

        </div>
      </div>
  </section>
@endsection
