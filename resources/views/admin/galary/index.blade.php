@extends('././layouts.master')

@section('content')
  <section class="content">

    <div class="container-fluid ">
      <div class="card  p-4">
        <h5 class="card-header">
          <span>
            {{ __('galary.galaris') }}
          </span>
          <span>
            <a href="{{ route('galary.create') }}" class="btn btn-success float-right btn-sm">
              {{ __('galary.new_galary') }}
            </a>

          </span>
        </h5>
        <div class="card-body">
          <table class="table table-responsive table-sm text-center">
            <thead گالری>
              <tr>
                <th>{{ __('galary.id') }}</th>
                <th>{{ __('galary.en_title') }}</th>
                <th>{{ __('galary.da_title') }}</th>
                <th>{{ __('galary.pa_title') }}</th>
                <th>{{ __('galary.status') }}</th>
                {{-- <th>{{ __('galary.created_by') }}</th> --}}
                {{-- <th>{{ __('galary.updated_by') }}</th> --}}
                <th>{{ __('galary.created_at') }}</th>
                {{-- <th>{{ __('galary.updated_at') }}</th> --}}
                <th>{{ __('galary.action') }}</th>
                {{-- <th>ID</th>
                            <th>E-Title</th>
                            <th>D-Title</th>
                            <th>P-Title</th>
                            <th>Status</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th> --}}
              </tr>
            </thead>
            <tbody>
              @foreach ($galaries as $index => $galary)
                <tr key="{{ $galary->id }}">
                  <td>{{ $galaries->currentPage() * 10 - 10 + $index + 1 }}</td>
                  <td>{{ $galary->en_title }}</td>
                  <td>{{ $galary->da_title }}</td>
                  <td>{{ $galary->pa_title }}</td>
                  <td>{!! $galary->status
                      ? ' <input class="form-check-input" type="radio" checked disabled>'
                      : '<input class="form-check-input" type="radio" disabled>' !!}

                  </td>
                  {{-- <td>{{ $galary->created_by }}</td> --}}
                  {{-- <td>{{ $galary->updated_by }}</td> --}}
                  <td>{{ $galary->created_at }}</td>
                  {{-- <td>{{ $galary->updated_at }}</td> --}}
                  <td>
                    <a href="#" class="delete" id="{{ $galary->id }}"><i class="fa fa-trash"></i></a>
                    |<a href="{{ route('galary.edit', ['galary' => $galary->id]) }}"><i class="fa fa-edit"></i></a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <tfoot>
            {{ $galaries->links() }}
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
        cancelButtonText: "{{ __('notifecation.cancel') }}",
        confirmButtonText: "{{ __('notifecation.yes_delete_it') }}"
      }).then((result) => {
        if (result.isConfirmed) {

          var id = $(this).attr('id');
          var url = 'galary/' + id
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
