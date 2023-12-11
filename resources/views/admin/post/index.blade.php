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
                    {{ __('post.posts') }}
                    <span>
                        <a href="{{ route('post.create') }}" class="btn btn-success btn-sm float-right fa fa-add"></a>
                        {{-- <a href="{{ route('post.trash') }}" class="btn btn-danger btn-sm float-right"><i class="fa fa-trash"></i></a> --}}
                    </span>
                </h5>
                <div class="card-body">
                    <table class="table table-responsive table-row-bordered table-sm yajra-datatable">
                        <thead class="h5">
                            <tr>
                                <th>{{ __('post.id') }}</th>
                                <th>{{ __('post.title') }}</th>
                                <th>{{ __('post.sub_title') }}</th>
                                <th>{{ __('post.description') }}</th>
                                <th>{{ __('post.type') }}</th>
                                <th>{{ __('category.category') }}</th>
                                {{-- <th>{{ __('post.status') }}</th> --}}
                                <th>{{ __('post.created_at') }}</th>
                                <th>{{ __('post.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($posts as $index => $post)
                                <tr key="{{ $post->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="truncate-cell" title="{{ $post->en_title }}">{{ $post->en_title }}</td>
                                    <td class="truncate-cell" title="{{ $post->da_title }}">{{ $post->da_title }}</td>
                                    <td class="truncate-cell" title="{{ $post->pa_title }}">{{ $post->pa_title }}</td>
                                    <td>{!! $post->status ? ' <input class="form-check-input" type="radio" checked disabled>' : '<input class="form-check-input" type="radio" disabled>' !!}
                                    </td>
                                    <td>{{ date('Y-m-d', strtotime($post->created_at)) }}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-light-danger delete fa fa-trash" id="{{ $post->id }}"></a>
                                        &nbsp; | &nbsp;
                                        <a href="{{ route('post.edit', ['post' => $post->id]) }}" class="btn btn-light-primary fa fa-edit"></a>
                                    </td>
                                </tr>
                            @endforeach --}}
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
                "bInfo": false,
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "aaSorting": [
                    [0, "desc"]
                ],
                "language": {
                    "sProcessing": "{{ trans('dataTable.LOADING') }}<span class='spinner spinner-primary ml-10'></span>",
                    "sSearch": "{{ trans('dataTable.SEARCH') }}",
                    "paginate": {
                        "previous": "{{ trans('dataTable.PREVIOUS') }}",
                        "next": "{{ trans('dataTable.NEXT') }}"
                    },
                    "sEmptyTable": "{{ trans('dataTable.NO_RECORD_FOUND') }}"
                },
                processing: true,
                serverSide: true,
                ajax: "{{ route('post.index') }}",
                columns: [{
                        "data": 'id'
                    },
                    {
                        "data": 'title',
                        className: 'truncate-cell'
                    },
                    {
                        "data": 'sub_title',
                        className: 'truncate-cell'
                    },
                    {
                        "data": 'description',
                        className: 'truncate-cell'
                    },
                    {
                        "data": 'post_type',
                        className: 'text-center'
                    },
                    {
                        "data": 'categories',
                        className: 'text-center'
                    },
                    // {
                    //     "data": 'status',
                    //     className: 'text-center'
                    // },
                    {
                        "data": 'creation_date',
                        className: 'text-center'
                    },
                    {
                        "data": 'action',
                        className: 'text-center'
                    }
                ]
            });
        });

        $(document).on('click', '.delete', function() {
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
                    var url = "{{ route('post.delete') }}/" + id;

                    $.ajax({
                        url: url,
                        datatype: 'json',
                        success: function(data) {
                            $('.yajra-datatable').DataTable().ajax.reload();
                            Toast.fire({
                                icon: 'success',
                                title: "{{ __('notifecation.successdully_done') }}"
                            })
                        }
                    })
                }
            })
        });

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
        });

        @if (Session::has('success'))
            Toast.fire({
                icon: 'success',
                title: "{{ __('notifecation.successdully_done') }}"
            })
        @endif
    </script>
@endsection
