@extends('././layouts.master')

@section('content')
  <section class="content">

    <div class="container-fluid ">
      <div class="card  p-4">
        <h5 class="card-header">
          <span>
            {{ __('category.category') }}
          </span>
          <span>
            <a href="{{ route('category.create') }}"
              class="btn btn-success float-right btn-sm">{{ __('category.new_category') }}</a>
          </span>
        </h5>
        <div class="card-body">
          <table class="table table-responsive  table-sm text-center">
            <thead class="h5">
              <tr>
                <th>{{ __('category.id') }}</th>
                <th>{{ __('category.en_name') }}</th>
                <th>{{ __('category.da_name') }}</th>
                <th>{{ __('category.pa_name') }}</th>

                <th>{{ __('category.status') }}</th>
                <th>{{ __('category.main_menu') }}</th>
                {{-- <th>{{ __('category.created_by') }}</th> --}}
                {{-- <th>{{ __('category.updated_by') }}</th> --}}
                <th>{{ __('category.created_at') }}</th>
                {{-- <th>{{ __('category.updated_at') }}</th> --}}
                <th>{{ __('category.action') }}</th>
                {{-- <th>ID</th>
              <th>E-Name</th>
              <th>D-Name</th>
              <th>P-Name</th>
              <th>Status</th>
              <th>Mian Menu</th>
              <th>Created By</th>
              <th>Updated By</th>
              <th>Created At</th>
              <th>Updated At</th> --}}
                {{-- <th>Action</th> --}}
              </tr>
            </thead>
            <tbody>
              @foreach ($categories as $index => $category)
                <tr key="{{ $category->id }}">
                  <td>{{ $categories->currentPage() * 10 - 10 + $index + 1 }}</td>
                  <td>{{ $category->en_name }}</td>
                  <td>{{ $category->da_name }}</td>
                  <td>{{ $category->pa_name }}</td>
                  <td>{!! $category->status
                      ? ' <input class="form-check-input" type="radio" checked disabled>'
                      : '<input class="form-check-input" type="radio" disabled>' !!}

                  </td>
                  <td>{!! $category->main_menu
                      ? ' <input class="form-check-input" type="radio" checked disabled>'
                      : '<input class="form-check-input" type="radio" disabled>' !!}</td>
                  {{-- <td>{{ $category->created_by }}</td> --}}
                  {{-- <td>{{ $category->updated_by }}</td> --}}
                  <td>{{ $category->created_at }}</td>
                  {{-- <td>{{ $category->updated_at }}</td> --}}
                  <td>
                    <a href="#" class="delete" id="{{ $category->id }}"><i class="fa fa-trash"></i></a>
                    |<a href="{{ route('category.edit', ['category' => $category->id]) }}"><i class="fa fa-edit"></i></a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <tfoot>
            {{ $categories->links() }}
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
          var url = 'category/' + id
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
