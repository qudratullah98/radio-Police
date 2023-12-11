@extends('././layouts.master')

@section('content')
  <section class="content">

    <div class="container-fluid ">
      <div class="card  p-4">
        <h5 class="card-header">
          <span>
            {{ __('program.programs') }}
          </span>
          <span>
            <a href="{{ route('program.create') }}" class="btn btn-success float-right btn-sm">
              {{ __('program.new_program') }}</a>

          </span>
        </h5>
        <div class="card-body">
          <table class="table table-responsive table-sm text-center">
            <thead class="h5">
              <tr>
                <th>{{ __('program.id') }}</th>
                <th>{{ __('program.en_title') }}</th>
                <th>{{ __('program.da_title') }}</th>
                <th>{{ __('program.pa_title') }}</th>
                {{-- <th>{{ __('program.en_sub_title') }}</th>
                <th>{{ __('program.da_sub_title') }}</th>
                <th>{{ __('program.pa_sub_title') }}</th> --}}
                <th>{{ __('program.status') }}</th>
                {{-- <th>{{ __('program.created_by') }}</th> --}}
                {{-- <th>{{ __('program.updated_by') }}</th> --}}
                <th>{{ __('program.created_at') }}</th>
                {{-- <th>{{ __('program.updated_at') }}</th> --}}
                <th>{{ __('program.action') }}</th>
                {{-- <th>ID</th>
              <th>E-Title</th>
              <th>D-Title</th>
              <th>P-Title</th>
              <th>E-Sub-Title</th>
              <th>D-Sub-Title</th>
              <th>P-Sub-Title</th>
              <th>Status</th>
              <th>Created By</th>
              <th>Updated By</th>
              <th>Created At</th>
              <th>Updated At</th>
              <th>Action</th> --}}
              </tr>
            </thead>
            <tbody>
              @foreach ($programs as $index => $program)
                <tr key="{{ $program->id }}">
                  <td>{{ $programs->currentPage() * 10 - 10 + $index + 1 }}</td>
                  <td>{{ $program->en_title }}</td>
                  <td>{{ $program->da_title }}</td>
                  <td>{{ $program->pa_title }}</td>
                  {{-- <td>{{ $program->en_sub_title }}</td>
                  <td>{{ $program->da_sub_title }}</td>
                  <td>{{ $program->pa_sub_title }}</td> --}}
                  <td>{!! $program->status
                      ? ' <input class="form-check-input" type="radio" checked disabled>'
                      : '<input class="form-check-input" type="radio" disabled>' !!}

                  </td>
                  {{-- <td>{{ $program->created_by }}</td> --}}
                  {{-- <td>{{ $program->updated_by }}</td> --}}
                  <td>{{ $program->created_at }}</td>
                  {{-- <td>{{ $program->updated_at }}</td> --}}
                  <td>
                    <a href="#" class="delete" id="{{ $program->id }}"><i class="fa fa-trash"></i></a>
                    |<a href="{{ route('program.edit', ['program' => $program->id]) }}"><i class="fa fa-edit"></i></a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <tfoot>
            {{ $programs->links() }}
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
          var url = 'program/' + id
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
