@extends('././layouts.master')

@section('content')
  <section class="content">

    <div class="container-fluid ">
      <div class="card  p-4">
        <h5 class="card-header">
          {{ __('contact.message_list') }}
        </h5>
        <div class="card-body">
          <table class="table table-responsive  table-sm">
            <thead class="h5">
              <tr>
                <th>{{ __('contact.id') }}</th>
                <th>{{ __('contact.name') }}</th>
                <th>{{ __('contact.email') }}</th>
                <th>{{ __('contact.phone') }}</th>
                <th>{{ __('contact.message') }}</th>
                <th>{{ __('contact.created_at') }}</th>
                <th>{{ __('contact.action') }}</th>
                {{-- <th>ID</th>
              <th>Name</th>
              <th>E-mail</th>
              <th>Phone</th>
              <th>Message</th>
              <th>Created At</th>
              <th>Action</th> --}}
              </tr>
            </thead>
            <tbody>
              @foreach ($contacts as $index => $contact)
                <tr key="{{ $contact->id }}">
                  <td>{{ $contacts->currentPage() * 10 - 10 + $index + 1 }}</td>
                  <td>{{ $contact->name }}</td>
                  <td>{{ $contact->email }}</td>
                  <td>{{ $contact->phone }}</td>
                  <td>{{ $contact->message }}</td>
                  <td>{{ $contact->created_at }}</td>
                  <td>
                    {{-- <a href="#" class="delete" id="{{ $contact->id }}"><i class="fa fa-trash"></i></a>| --}}
                    <a href="{{ route('contact.detail', ['contact' => $contact->id]) }}"><i class="fa fa-edit"></i></a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <tfoot>
            {{ $contacts->links() }}
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
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: "{{ __('notifecation.cancel') }}"
        confirmButtonText: "{{ __('notifecation.yes_delete_it') }}"
      }).then((result) => {
        if (result.isConfirmed) {

          var id = $(this).attr('id');
          var url = 'contact/' + id
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
        title: "{{ __('notifecation.successdully_deleted') }}"
      })
    @endif
  </script>
@endsection
