@extends('layouts.app')

@section('title', 'Employee')

@section('employee', 'active')



@section('content')

    @can('create_employee')
        <div>
            <a href="{{ route('employees.create') }}" class=" btn btn-success mb-3"><i class="fa fa-plus-circle me-1"></i>CREATE
                EMPLOYEE</a>
        </div>
    @endcan

    <div class=" card">
        <div class=" card-body">
            <table id="dataTable" class="table nowrap " style="width:100%">
                <thead>
                    <th class=" no-sort text-center">Profile</th>
                    <th class=" no-sort ">Employee ID</th>
                    <th class=" ">Phone</th>
                    <th class=" no-sort ">Email</th>
                    <th class=" no-sort ">Deparment</th>
                    <th class=" no-sort ">Role</th>
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
                    url: "{{ route('employees.index') }}"
                },
                columns: [{
                        data: 'profile_img',
                        name: 'profile_img',
                        class: 'text-center'
                    },
                    {
                        data: 'employee_id',
                        name: 'employee_id',
                    },
                    {
                        data: 'phone',
                        name: 'phone',
                    },
                    {
                        data: 'email',
                        name: 'email',

                    },
                    {
                        data: 'department_name',
                        name: 'department_name',

                    },
                    {
                        data: 'role_name',
                        name: 'role_name',
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
                    [7, 'desc']
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
                            url: '/employees/' + id,
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
