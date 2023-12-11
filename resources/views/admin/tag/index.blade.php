@extends('././layouts.master')

@section('content')
  <section class="content">

    <div class="container-fluid ">
      <div class="card  p-4">
        <h5 class="card-header">
          <span>
            برچسپ ها
          </span>
          <span>
            <a href="{{ route('tag.create') }}" class="btn btn-success float-right">برچسپ جدید</a>

          </span>
        </h5>
        <div class="card-body">
          <table class="table table-responsive table-sm text-center">
            <thead>
              <tr>
                <th>ID</th>
                <th>E-Name</th>
                <th>D-Name</th>
                <th>P-Name</th>
                <th>Status</th>
                <th>Created By</th>
                <th>Updated By</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($tags as $index => $tag)
                <tr key={{ $tag->id }}>
                  <td>{{ $tags->currentPage() * 10 - 10 + $index + 1 }}</td>
                  <td>{{ $tag->en_name }}</td>
                  <td>{{ $tag->da_name }}</td>
                  <td>{{ $tag->pa_name }}</td>
                  <td>{!! $tag->status
                      ? ' <input class="form-check-input" type="radio" checked disabled>'
                      : '<input class="form-check-input" type="radio" disabled>' !!}

                  </td>
                  <td>{{ $tag->created_by }}</td>
                  <td>{{ $tag->updated_by }}</td>
                  <td>{{ $tag->created_at }}</td>
                  <td>{{ $tag->updated_at }}</td>
                  <td>
                    <a href="#" class="delete" id="{{ $tag->id }}"><i class="fa fa-trash"></i></a>
                    |<a href="{{ route('tag.edit', ['tag' => $tag->id]) }}"><i class="fa fa-edit"></i></a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <tfoot>
            {{ $tags->links() }}
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
      }).then((result) => {
        if (result.isConfirmed) {

          var id = $(this).attr('id');
          var url = 'tag/' + id
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
        // title: "{{ Session::get('success') }}"
      })
    @endif
  </script>
@endsection
