@extends('layouts.app')

@section('title', 'Role')

@section('role', 'active')


@section('content')
    @can('create_permission')
        <div>
            <a href="{{ route('role.create') }}" class=" btn btn-success mb-3"><i class="fa fa-plus-circle me-1"></i>CREATE
                ROLE</a>
        </div>
    @endcan
    <div class=" card">
        <div class=" card-body">
            <table id="dataTable" class="table nowrap " style="width:100%">
                <thead>
                    <th class=" ">Role</th>
                    <th class=" ">Permissions</th>
                    <th class=" no-sort td-actions ">Action</th>
                    <th class=" hidden">Updated At</th>
                </thead>
            </table>

        </div>

    </div>


@endsection


@section('js')

    <script>
        $(document).ready(function() {
            var table = $('#dataTable').DataTable({
                ajax: {
                    url: "{{ route('role.index') }}"
                },
                columns: [{
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'permissions',
                        name: 'permissions',
                    },
                    {
                        data: 'action',
                        name: 'action',
                    },

                    {
                        data: 'updated_at',
                        name: 'updated_at',
                    },
                ],
                order: [
                    [2, 'desc']
                ],
            });


            $(document).on('click', '.delete', function(e) {
                e.preventDefault();
                var id = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to delete!",
                    icon: 'warning',
                    reverseButtons: true,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/role/' + id,
                            type: 'DELETE',
                            success: function() {
                                table.ajax.reload();
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter',
                                            Swal.stopTimer)
                                        toast.addEventListener('mouseleave',
                                            Swal.resumeTimer)
                                    }
                                })
                                Toast.fire({
                                    icon: 'success',
                                    title: "Successfully Deleted"
                                });
                            }
                        })
                    }
                })
            })
        })
    </script>
@endsection
