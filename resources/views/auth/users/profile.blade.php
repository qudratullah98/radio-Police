@extends('layouts.master')
{{-- magosh --}}
@section('content')
  <div class="row mt-4">
    <div class="col-md-3">
      <!-- Profile Image -->
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <div class="text-center mb-4">
            <img class="profile-user-img img-fluid img-circle"
              src="{{ asset($user->photo == null ? 'assets/media/avatars/blank.png' : $user->photo) }}"
              style="width: 120px; border-radius: 60px;" alt="User profile picture">
          </div>

          <h3 class="profile-username text-center">{{ $user->name }}</h3>

          <h5 class="text-muted text-center">{{ $user->email }}</h5>

          {{-- <h5 class="text-muted text-center">{{ $dep->name_dr }}</h5> --}}
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="card">
        <div class="py-6 px-6">
          <h4 class="d-inline">حساب کاربری</h4>
          <button type="button" class="btn btn-sm btn-primary" style="float: left;" data-bs-toggle="modal"
            data-bs-target="#password_modal">تغییر رمز عبور</button>
        </div>
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
    {{-- <div class="modal fade" id="updateModal" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">@lang('auth/profile.Your_Complete_Information')</h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('update.profile') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-xs-12 col-md-12">
                                    <label for="">@lang('auth/profile.Select_Your_Photo')</label>
                                    <input type="file" accept="image/*" class="form-control-file" name="photo">
                                </div>
                                <div class="col-xs-12 col-md-12">
                                    <label for="">@lang('auth/profile.Information_About_You')</label>
                                    <textarea class="form-control" name="information" cols="30" rows="8">{{ $user->information }}</textarea>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-dark" data-dismiss="modal" type="button">@lang('auth/profile.Close')</button>
                                <button class="btn btn-primary" type="submit">@lang('auth/profile.Save')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}

    <div id="password_modal" tabindex="-1" role="dialog" class="modal fade">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h4 class="modal-title">تغییر رمز</h4>
            <button type="button" class="close" data-bs-dismiss="modal">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form id="passwordForm">
            <div class="modal-body">
              @csrf
              <div class="row">
                <div class="col-xs-12 col-md-12">
                  <label for="old_password">رمز گذشته</label>
                  <input type="password" class="form-control" id="old_password" name="old_password">
                  @error('old_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-xs-12 col-md-6">
                  <label for="password">رمز جدید</label>
                  <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="col-xs-12 col-md-6">
                  <label for="password_confirmation">تایید رمز جدید</label>
                  <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-dark" data-bs-dismiss="modal" type="button">بستن</button>
              <button class="btn btn-primary" type="submit">ذخیره</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
  <script>
    $(document).ready(function() {
      var valid = $('#passwordForm').validate({
        rules: {
          old_password: {
            required: true,
          },
          password: {
            required: true,
            minlength: 6
          },
        },
        messages: {
          old_password: {
            required: '<span class="text-danger" style="font-size:13px; font-weight:bold">درج رمز گذشته ضروری میباشد</span>',
          },
          password: {
            required: '<span class="text-danger" style="font-size:13px; font-weight:bold">درج رمز جدید ضروری میباشد</span>',
            minlength: '<span class="text-danger" style="font-size:13px; font-weight:bold">رمز جدید باید از ۶ حرف کم نباشد</span>',
          },
        }
      });
    });

    $(document).on('submit', '#passwordForm', function(e) {
      e.preventDefault();

      var url = "{{ URL('change_password') }}";

      $.ajax({
        url: url,
        method: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(response) {
          if (response.status === true) {
            $('#passwordForm')[0].reset();
            $('#password_modal').modal('hide');
            Swal.fire({
              title: 'معلومات ذخیره شد',
              text: response.data,
              icon: 'success',
              showConfirmButton: true, // hide the "OK" button
              allowOutsideClick: false // prevent the user from clicking outside the dialog
            });
          } else {
            $.each(response.data, function(prefix, val) {
              var error = '<label id="' + prefix + '-error" class="error" for="' + prefix + '">' + val[0] +
                '</label>';
              $("input[name=" + prefix + "]").after(error);
            });
          }
        },
        error: function() {
          Swal.fire({
            title: 'معلومات ذخیره نشد',
            text: response.data,
            icon: 'error'
          })
        }
      });
    });
  </script>
@endsection
