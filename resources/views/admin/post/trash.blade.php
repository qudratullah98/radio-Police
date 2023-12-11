@extends('././layouts.master')

@section('content')
  <section class="content">

    <div class="container-fluid ">
      <div class="card p-2">
        <h5 class="card-header">
          <span>
            حذف شده
          </span>
        </h5>
        <div class="card-body">
          <table class="table table-responsive  table-sm">
            <thead>
              <tr>
                <th>ID</th>
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
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($posts as $index => $post)
                <tr key="{{ $post->id }}">
                  <td>{{ $posts->currentPage() * 10 - 10 + $index + 1 }}</td>
                  <td>{{ $post->en_title }}</td>
                  <td>{{ $post->da_title }}</td>
                  <td>{{ $post->pa_title }}</td>
                  <td>{{ $post->en_sub_title }}</td>
                  <td>{{ $post->da_sub_title }}</td>
                  <td>{{ $post->pa_sub_title }}</td>
                  <td>{!! $post->status
                      ? ' <input class="form-check-input" type="radio" checked disabled>'
                      : '<input class="form-check-input" type="radio" disabled>' !!}

                  </td>
                  <td>{{ $post->created_by }}</td>
                  <td>{{ $post->updated_by }}</td>
                  <td>{{ $post->created_at }}</td>
                  <td>{{ $post->updated_at }}</td>
                  <td>
                    <a href="#" class="delete" id="{{ $post->id }}"><i class="fa fa-trash"></i></a>
                    |<a href="{{ route('post.restore', ['id' => $post->id]) }}"><i class="fa fa-edit"></i></a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>

          <tfoot>
            {{ $posts->links() }}
          </tfoot>
        </div>
      </div>
  </section>
@endsection

@section('script')
  <script <script>
    $('.delete').click(function() {


      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {

          var id = $(this).attr('id');
          var url = 'force-delete/' + id
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
          // Swal.fire(
          //     'Deleted!',
          //     'Your file has been deleted.',
          //     'success'
          // )
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
        title: "{{ Session::get('success') }}"
      })
    @endif
  </script>
@endsection
