@extends('././layouts.master')
@section('content')
<style>
    .truncate-cell {
        max-width: 200px;
        /* Adjust the max-width according to your requirements */
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .truncate-cell::after {
        content: "...";
    }

</style>

<section class="content">
    <div class="container-fluid ">
        <div class="card p-2">
            <h5 class="card-header my-5 fs-1">
                {{ __('slider.slider') }}
                <span>
                    <a href="{{ route('slider.create') }}" class="btn btn-success btn-sm float-right fa fa-add"></a>
                    {{-- <a href="{{ route('post.trash') }}" class="btn btn-danger btn-sm float-right"><i class="fa fa-trash"></i></a> --}}
                </span>
            </h5>
            <div class="card-body">
                <table class="table table-responsive table-row-bordered table-sm yajra-datatable">
                    <thead class="h5">
                        <tr>
                            <th>{{ __('post.id') }}</th>
                            <th>{{ __('post.title') }}</th>
                            <th>{{ __('post.title') }}</th>
                            <th>{{ __('تاریخ') }}</th>
                            <th>{{ __('post.status') }}</th>
                            <th>{{ __('post.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
              
                    </tbody>
                </table>
                <tfoot>
                    {{-- {{ $posts->links() }} --}}
                </tfoot>
            </div>
        </div>
</section>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('.yajra-datatable').DataTable({
            "bInfo": false
            , "paging": true
            , "lengthChange": false
            , "searching": true
            , "ordering": true
            , "aaSorting": [
                [0, "desc"]
            ]
            , "language": {
                "sProcessing": "{{ trans('dataTable.LOADING') }}<span class='spinner spinner-primary ml-10'></span>"
                , "sSearch": "{{ trans('dataTable.SEARCH') }}"
                , "paginate": {
                    "previous": "{{ trans('dataTable.PREVIOUS') }}"
                    , "next": "{{ trans('dataTable.NEXT') }}"
                }
                , "sEmptyTable": "{{ trans('dataTable.NO_RECORD_FOUND') }}"
            }
            , processing: true
            , serverSide: true
            , ajax: "{{ route('slider.index') }}"
            , columns: [{
                    "data": 'id'
                },


                {
                    "data": 'en_title'
                    , className: 'text-center'
                }, {
                    "data": 'da_title'
                    , className: 'text-center'
                }
                , {
                    "data": 'status'
                    , className: 'text-center'
                }
                , {
                    "data": 'creation_date'
                    , className: 'text-center'
                }
                , {
                    "data": 'action'
                    , className: 'text-center'
                }
            ]
        });
    });

    $(document).on('click', '.delete', function() {
        Swal.fire({
            title: "{{ __('notifecation.are_you_sure') }}"
            , text: "{{ __('notifecation.you_wont_be_able_to_revert_this') }}"
            , icon: 'warning'
            , showCancelButton: true
            , confirmButtonColor: '#3085d6'
            , cancelButtonColor: '#d33'
            , confirmButtonText: "{{ __('notifecation.yes_delete_it') }}"
            , cancelButtonText: "{{ __('notifecation.cancel') }}"
        , }).then((result) => {
            if (result.isConfirmed) {
                var id = $(this).attr('id');
                var url = "{{ route('slider.delete', ['slider' => ':id']) }}";
                url = url.replace(':id', id);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , url: url
                    , datatype: 'json'
                    , method: "DELETE"
                    , success: function(data) {
                        $('.yajra-datatable').DataTable().ajax.reload();
                        Toast.fire({
                            icon: 'success'
                            , title: "{{ __('notifecation.successdully_done') }}"
                        })
                    }
                })
            }
        })
    });

    const Toast = Swal.mixin({
        toast: true
        , position: 'top-end'
        , showConfirmButton: false
        , timer: 3000
        , timerProgressBar: true
        , didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    @if(Session::has('success'))
    Toast.fire({
        icon: 'success'
        , title: "{{ __('notifecation.successdully_done') }}"
    })
    @endif

</script>
@endsection
