@extends('././layouts.master')

@section('content')
  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">{{ __('setting.setting') }}</h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-12 col-md-12 col-lg-2 order-2 order-md-1">
            <div class="row">
              <div class="col-12 mb-4">

                <h4>{{ $setting->da_nav_title }}</h4>
                <div class="post">
                  <p>
                    <a href="#" class="link-black text-sm"><i
                        class="fas fa-link mr-1"></i>{{ $setting->da_nav_subtitle }}</a>
                  </p>
                </div>
                <div class="post clearfix">
                  <div class="user-block">
                    <div class="description">{{ $setting->created_at }}</div>
                    <div class="description">{{ $setting->updated_at }}</div>
                  </div>
                </div>
              </div>
              <div class="col-12 mb-4">
                <h4>{{ $setting->pa_nav_title }}</h4>
                <div class="post">
                  <p>
                    <a href="#" class="link-black text-sm"><i
                        class="fas fa-link mr-1"></i>{{ $setting->pa_nav_subtitle }}</a>
                  </p>
                </div>
                <div class="post clearfix">
                  <div class="user-block">
                    <div class="description">{{ $setting->created_at }}</div>
                    <div class="description">{{ $setting->updated_at }}</div>
                  </div>
                </div>
              </div>
              <div class="col-12 mb-4">
                <h4>{{ $setting->en_nav_title }}</h4>
                <div class="post">
                  <p>
                    <a href="#" class="link-black text-sm"><i
                        class="fas fa-link mr-1"></i>{{ $setting->en_nav_subtitle }}</a>
                  </p>
                </div>
                <div class="post clearfix">
                  <div class="user-block">
                    <div class="description">{{ $setting->created_at }}</div>
                    <div class="description">{{ $setting->updated_at }}</div>
                  </div>
                </div>
              </div>

              <div class="col-12 mb-4">
                <div class="">
                  <img class="col-sm" src="{{ asset('storage/all_images/' . $setting->tab_icon) }}" alt="Icon"
                    style="width: 50%; height: 50%;">

                </div>
                <div class="">
                  <img class="col-sm" src="{{ asset('storage/all_images/' . $setting->nav_logo) }}" alt="Logo"
                    style="width: 50%; height: 50%;">

                </div>
              </div>

            </div>
          </div>
          <div class="col-12 col-md-12 col-lg-8 order-1 order-md-2 ">
            <div>
              <h3>{{ __('setting.da_about_us') }}</h3>
              <p>
                {{ $setting->da_about_us }}
              </p>
            </div>

            <div>
              <h3>{{ __('setting.pa_about_us') }}</h3>
              <p>
                {{ $setting->pa_about_us }}
              </p>
            </div>

            <div>
              <h3>{{ __('setting.en_about_us') }}</h3>
              <p>
                {{ $setting->en_about_us }}
              </p>
            </div>
            {{-- <p>
              {{ $setting->pa_about_us }}
            </p>
            <p>
              {{ $setting->en_about_us }}
            </p> --}}
          </div>
          <div class="col-12 col-md-12 col-lg-2 order-1 order-md-2">
            <h4 class="text-primary"><i class="fas fa-paint-brush"></i>{{ __('setting.da_exact_address') }}</h4>
            <p class="text-muted">{{ $setting->da_exact_address }}</p>
            <br>
            <div class="text-muted">
              <p class="text-sm">{{ __('setting.phone') }}
                <b class="d-block">{{ $setting->phone }}</b>
              </p>
              <p class="text-sm">{{ __('setting.email') }}
                <b class="d-block">{{ $setting->email }}</b>
              </p>
              <p class="text-sm">{{ __('setting.map_location') }}
                <b class="d-block">{{ $setting->map_location }}</b>
              </p>
            </div>
            <h5 class="mt-5 text-muted">{{ __('setting.contact_us') }}</h5>
            <ul class="list-unstyled">
              <li>
                <a href="" class="btn-link text-secondary"><i class="far fa-fw fa fa-phone"></i>
                  {{ $setting->phone }}</a>
              </li>
              <li>
                <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-envelope"></i>
                  {{ $setting->email }}</a>
              </li>
            </ul>
            <div class="text-center mt-5 mb-3">
              <a href="{{ route('setting.edit', ['setting' => $setting->id]) }}"
                class="btn btn-sm btn-primary">{{ __('setting.update') }}</a>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
@endsection

@section('script')
  <script <script>
    $('.delete').click(function() {


      Swal.fire({
        title: "{{ __('notifecation.are_you_sure') }}",
        text: "{{ __('notifecation.you_wont_be_able_to_revert_this') }}",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: "{{ __('notifecation.cancel') }}"
        confirmButtonText: "{{ __('notifecation.yes_delete_it') }}"
      }).then((result) => {
        if (result.isConfirmed) {

          var id = $(this).attr('id');
          var url = 'setting/' + id
          console.log(id)
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: 'DELETE',
            datatype: 'json',
            data: {
              "_method": "DELETE",
            },
            success: function(data) {
              location.reload();
            }
          })
        }
      })
    })
  </script>
  <script>
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    })
    @if (Session::has('success'))
      Toast.fire({
        icon: 'success',
        title: "{{ __('notifecation.successdully_done') }}"
      })
    @endif
  </script>
@endsection
