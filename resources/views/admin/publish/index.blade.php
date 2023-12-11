@extends('././layouts.master')

@section('content')
  <section class="content">

    <div class="container-fluid ">
      <div class="shadow-lg p-3 mb-5 bg-body rounded p-10">
        <div class="row">
          <h5 class="p-2 col-sm">
            {{ __('publish.publish') }}
          </h5>
          <span class="btn-group col-sm" role="group" aria-label="Basic example">
            @foreach ($publishes as $days)
              <tr key="{{ $days->id }}">
                <td>
                  <button class="btn btn-primary filter" value="{{ $days->id }}"
                    id="{{ $days->id }}">{{ $days->en_name }}</button>
                </td>
              </tr>
            @endforeach
          </span>
        </div>

        <div class="col-sm my-auto d-grid gap-3">
          <table class="table table-responsive table-sm text-center" id="publisher">
            <thead class="h5">
              <tr>
                <th>{{ __('publish.id') }}</th>
                <th>{{ __('publish.en_title') }}</th>
                <th>{{ __('publish.da_title') }}</th>
                <th>{{ __('publish.pa_title') }}</th>
                {{-- <th>{{ __('publish.en_sub_title') }}</th>
                <th>{{ __('publish.da_sub_title') }}</th>
                <th>{{ __('publish.pa_sub_title') }}</th> --}}
                <th>{{ __('publish.status') }}</th>
                {{-- <th>{{ __('publish.created_by') }}</th> --}}
                {{-- <th>{{ __('publish.updated_by') }}</th> --}}
                <th>{{ __('publish.created_at') }}</th>
                {{-- <th>{{ __('publish.updated_at') }}</th> --}}
                {{-- <th>{{ __('publish.action') }}</th> --}}
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
              @foreach ($publishes as $index => $publish)
                <tr key="{{ $index }}">
                  @foreach ($publish->programs as $y_index => $publish_program)
                <tr key="{{ $publish_program->id }}">
                  {{-- <td>{{ $publish->->currentPage() * 10 - 10 + $index + 1 }}</td> --}}
                  <td>{{ $index }}</td>
                  <td>{{ $publish_program->en_title }}</td>
                  <td>{{ $publish_program->da_title }}</td>
                  <td>{{ $publish_program->pa_title }}</td>
                  {{-- <td>{{ $publish_program->en_sub_title }}</td>
                  <td>{{ $publish_program->da_sub_title }}</td>
                  <td>{{ $publish_program->pa_sub_title }}</td> --}}
                  <td>{!! $publish_program->status
                      ? ' <input class="form-check-input" type="radio" checked disabled>'
                      : '<input class="form-check-input" type="radio" disabled>' !!}

                  </td>
                  {{-- <td>{{ $publish_program->created_by }}</td> --}}
                  {{-- <td>{{ $publish_program->updated_by }}</td> --}}
                  <td>{{ $publish_program->created_at }}</td>
                  {{-- <td>{{ $publish_program->updated_at }}</td> --}}
                  {{-- <td>
                                        <a href="#" class="delete" id="{{ $publish_program->id }}"><i
                                                class="fa fa-trash"></i></a>
                                        |<a
                                            href="{{ route('publish_program.edit', ['publish_program' => $publish_program->id]) }}"><i
                                                class="fa fa-edit"></i></a>
                                    </td> --}}
                </tr>
              @endforeach
              </tr>
              @endforeach
            </tbody>
          </table>

          <table class="table table-responsive  table-sm d-none" id="table_second">
            <thead>
              <tr>
                <th>ID</th>
                <th>E-Title</th>
                <th>D-Title</th>
                <th>P-Title</th>
                <th>Priority</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="publish">
            </tbody>
          </table>

          <tfoot>
            {{ $publishes->links() }}
          </tfoot>
        </div>
      </div>
  </section>
@endsection

@section('script')
  <script>
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
          var url = 'social_media/' + id;
          console.log(id);
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
          });
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          );
        }
      })
    });
  </script>

  <script>
    $('.filter').click(function() {
      var id = $(this).attr('id');
      var url = 'publish/' + id;


      // $(`#${id}`).attr('disabled', 'disabled')
      console.log(id);
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url,
        type: 'GET',
        datatype: 'json',
        data: {
          "_method": "GET",
        },
        success: function(data) {
          $('#publisher').hide();
          $('#table_second').removeClass('d-none');

          var html = '';
          for (var i = 0; i < data.length; i++) {
            html += `<tr>
                                        <td>${i + 1}</td>
                                        <td>${data[i].en_title}</td>
                                        <td>${data[i].da_title}</td>
                                        <td>${data[i].pa_title}</td>
                                    </tr>`
          };
          $('#publish').html(html);

          $('#publisher').hide();
          $('#table_second').removeClass('d-none');
        }
      });


    });
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
    if (Session::has('success')) {
      Toast.fire({
        icon: 'success',
        title: "{{ __('notifecation.successdully_done') }}"
      });
    }
  </script>
@endsection
