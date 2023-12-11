@extends('././layouts.master')

@section('content')
  <section class="content">

    <div class="container-fluid ">
      <div class="card  p-4">
        <h5 class="card-header">
          <span>
            {{ __('day_of_week.day_of_week') }}
          </span>
          <span>
            <a href="{{ route('day_of_week.create') }}" class="btn btn-success float-right">
              {{ __('day_of_week.new_day_of_week') }}</a>

          </span>
        </h5>
        <div class="card-body">
          <table class="table table-responsive table-sm text-center">
            <thead class="h5">
              <tr>
                <th>{{ __('day_of_week.id') }}</th>
                <th>{{ __('day_of_week.en_name') }}</th>
                <th>{{ __('day_of_week.da_name') }}</th>
                <th>{{ __('day_of_week.pa_name') }}</th>
                <th>{{ __('day_of_week.status') }}</th>
                {{-- <th>{{ __('day_of_week.created_by') }}</th> --}}
                {{-- <th>{{ __('day_of_week.updated_by') }}</th> --}}
                <th>{{ __('day_of_week.created_at') }}</th>
                {{-- <th>{{ __('day_of_week.updated_at') }}</th> --}}
                <th>{{ __('day_of_week.action') }}</th>
                {{-- <th>ID</th>
              <th>E-Name</th>
              <th>D-Name</th>
              <th>P-Name</th>
              <th>Status</th>
              <th>Created By</th>
              <th>Updated By</th>
              <th>Created At</th>
              <th>Updated At</th>
              <th>Action</th> --}}
              </tr>
            </thead>
            <tbody>
              @foreach ($day_of_weeks as $index => $day_of_week)
                <tr key="{{ $day_of_week->id }}">
                  <td>{{ $day_of_weeks->currentPage() * 10 - 10 + $index + 1 }}</td>
                  <td>{{ $day_of_week->en_name }}</td>
                  <td>{{ $day_of_week->da_name }}</td>
                  <td>{{ $day_of_week->pa_name }}</td>
                  <td>{!! $day_of_week->status
                      ? ' <input class="form-check-input" type="radio" checked disabled>'
                      : '<input class="form-check-input" type="radio" disabled>' !!}

                  </td>
                  {{-- <td>{{ $day_of_week->created_by }}</td> --}}
                  {{-- <td>{{ $day_of_week->updated_by }}</td> --}}
                  <td>{{ $day_of_week->created_at }}</td>
                  {{-- <td>{{ $day_of_week->updated_at }}</td> --}}
                  <td>
                    <a href="#" class="delete" id="{{ $day_of_week->id }}"><i class="fa fa-trash"></i></a>
                    |<a href="{{ route('day_of_week.edit', ['day_of_week' => $day_of_week->id]) }}"><i
                        class="fa fa-edit"></i></a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <tfoot>
            {{ $day_of_weeks->links() }}
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
          var url = 'day_of_week/' + id
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
