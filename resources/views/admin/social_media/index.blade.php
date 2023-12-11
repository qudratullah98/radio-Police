@extends('././layouts.master')

@section('content')
  <section class="content">

    <div class="container-fluid ">
      <div class="card  p-4">
        <h5 class="card-header">
          <span>
            {{ __('socialMedia.socialMedias') }}
          </span>
          <span>
            <a href="{{ route('social_media.create') }}"
              class="btn btn-success float-right btn-sm">{{ __('socialMedia.newSocialMedia') }}</a>

          </span>
        </h5>
        <div class="card-body">
          <table class="table table-responsive table-sm text-center">
            <thead class="h5">
              <tr>
                <th>{{ __('socialMedia.id') }}</th>
                <th>{{ __('socialMedia.en_title') }}</th>
                <th>{{ __('socialMedia.da_title') }}</th>
                <th>{{ __('socialMedia.pa_title') }}</th>
                {{-- <th>{{ __('socialMedia.icon') }}</th> --}}
                {{-- <th>{{ __('socialMedia.url') }}</th> --}}
                <th>{{ __('socialMedia.status') }}</th>
                {{-- <th>{{ __('socialMedia.created_by') }}</th> --}}
                {{-- <th>{{ __('socialMedia.updated_by') }}</th> --}}
                <th>{{ __('socialMedia.created_at') }}</th>
                {{-- <th>{{ __('socialMedia.updated_at') }}</th> --}}
                <th>{{ __('socialMedia.action') }}</th>
                {{-- <th>ID</th>
              <th>E-Title</th>
              <th>D-Title</th>
              <th>P-Title</th>
              <th>Icon</th>
              <th>Url</th>
              <th>Status</th>
              <th>Created By</th>
              <th>Updated By</th>
              <th>Created At</th>
              <th>Updated At</th>
              <th>Action</th> --}}
              </tr>
            </thead>
            <tbody>
              @foreach ($social_medias as $index => $social_media)
                <tr key="{{ $social_media->id }}">
                  <td>{{ $social_medias->currentPage() * 10 - 10 + $index + 1 }}</td>
                  <td>{{ $social_media->en_title }}</td>
                  <td>{{ $social_media->da_title }}</td>
                  <td>{{ $social_media->pa_title }}</td>
                  {{-- <td>{{ $social_media->icon }}</td> --}}
                  {{-- <td>{{ $social_media->url }}</td> --}}
                  <td>{!! $social_media->status
                      ? ' <input class="form-check-input" type="radio" checked disabled>'
                      : '<input class="form-check-input" type="radio" disabled>' !!}

                  </td>
                  {{-- <td>{{ $social_media->created_by }}</td> --}}
                  {{-- <td>{{ $social_media->updated_by }}</td> --}}
                  <td>{{ $social_media->created_at }}</td>
                  {{-- <td>{{ $social_media->updated_at }}</td> --}}
                  <td>
                    <a href="#" class="delete" id="{{ $social_media->id }}"><i class="fa fa-trash"></i></a>
                    |<a href="{{ route('social_media.edit', ['social_media' => $social_media->id]) }}"><i
                        class="fa fa-edit"></i></a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <tfoot>
            {{ $social_medias->links() }}
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
        cancelButtonText: "{{ __('notifecation.cancel') }}"
        confirmButtonText: "{{ __('notifecation.yes_delete_it') }}"
      }).then((result) => {
        if (result.isConfirmed) {

          var id = $(this).attr('id');
          var url = 'social_media/' + id
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
