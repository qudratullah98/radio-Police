@extends('././layouts.master')

@section('content')
  <section class="content">

    <div class="container-fluid ">
      <div class="card  p-4">
        <h5 class="card-header">
          <span>
            {{ __('video.videos') }}
          </span>
          <span>
            <a href="{{ route('video.create') }}" class="btn btn-success float-right btn-sm">
              {{ __('video.new_video') }}</a>

          </span>
        </h5>
        <div class="card-body">
          <table class="table table-responsive table-sm text-center">
            <thead class="h5">
              <tr>
                <th>{{ __('video.id') }}</th>
                <th>{{ __('video.en_title') }}</th>
                <th>{{ __('video.da_title') }}</th>
                <th>{{ __('video.pa_title') }}</th>

                <th>{{ __('video.status') }}</th>

                <th>{{ __('video.created_at') }}</th>
                <th>{{ __('video.action') }}</th>

              </tr>
            </thead>
            <tbody>
              @foreach ($videos as $index => $video)
                <tr key="{{ $video->id }}">
                  <td>{{ $videos->currentPage() * 10 - 10 + $index + 1 }}</td>
                  <td>{{ $video->en_title }}</td>
                  <td>{{ $video->da_title }}</td>
                  <td>{{ $video->pa_title }}</td>

                  <td>{!! $video->status
                      ? ' <input class="form-check-input" type="radio" checked disabled>'
                      : '<input class="form-check-input" type="radio" disabled>' !!}

                  </td>

                  <td>{{ $video->created_at }}</td>
                  <td>
                    <a href="#" class="delete" id="{{ $video->id }}"><i class="fa fa-trash"></i></a>
                    |<a href="{{ route('video.edit', ['video' => $video->id]) }}"><i class="fa fa-edit"></i></a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <tfoot>
            {{ $videos->links() }}
          </tfoot>
        </div>
      </div>
  </section>
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
        confirmButtonText: "{{ __('notifecation.yes_delete_it') }}",
        cancelButtonText: "{{ __('notifecation.cancel') }}",
      }).then((result) => {
        if (result.isConfirmed) {

          var id = $(this).attr('id');
          var url = 'video/' + id
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
