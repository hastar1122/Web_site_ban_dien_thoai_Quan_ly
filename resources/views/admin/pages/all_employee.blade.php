@extends('admin.layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Danh Mục Nhân Viên</h1>
        <div class="d-flex justify-content-end">
            <div class="input-group" style="width:260px;">
                <form action="" class="form-inline">
                    <input type="search" class="form-control  rounded" name="employee_search" id="employee-search"
                        placeholder="Search by name.." aria-label="Search" aria-describedby="search-addon" required />
                    <button type="submit" class="btn btn-outline-primary btn-search"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
        <br>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-1 font-weight-bold text-primary">Danh sách nhân viên</h6>
                <a class="btn btn-light btn-outline-primary btn-add" data-toggle="modal" data-target="#modal-employee-add">
                    <i class="fas fa-plus-circle fa-lg "></i>&nbsp;Thêm nhân viên</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" id="" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Mã nhân viên</th>
                                <th>Tên tài khoản</th>
                                <th>Ảnh</th>
                                <th>Tên nhân viên</th>
                                <th>Địa chỉ</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_employee_get as $employee)
                                <tr>
                                    <td>{{ $employee->UserID }}</td>
                                    <td>{{ $employee->UserAccount }}</td>
                                    @if (!empty($employee->Image))
                                        <td><img src="{{ asset('/admin/img/' . $employee->Image) }}" width="70px"
                                                height="70px" alt=""></td>
                                    @else
                                        <td></td>
                                    @endif
                                    <td>{{ $employee->UserName }}</td>
                                    <td>{{ $employee->Address }}</td>
                                    <td>{{ $employee->Email }}</td>
                                    <td>{{ $employee->PhoneNumber }}</td>
                                    <td>
                                        <a data-url="{{ URL::to('/edit-employee/' . $employee->UserID) }}" type="button"
                                            class="btn btn-info btn-edit"><i class="fas fa-edit"></i></a>
                                        <a data-url="{{ URL::to('/delete-employee/' . $employee->UserID) }}" type="button"
                                            class="btn btn-danger btn-delete"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div style="margin-left:17px;">
                {{ $all_employee_get->appends(request()->all())->links() }}
            </div>
        </div>

    </div>

    @include('admin.pages.employee.add')
    @include('admin.pages.employee.edit')

    <script type="text/javascript">
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();

            $(".nav-1").addClass("show");

            $('.nav-link-1').removeClass('collapsed');

            $('.btn-add').click(function(e) {
                $('#modal-employee-add').modal('show');
            });


            $("#form-employee-add").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                var url = $(this).attr("data-url");
                $.ajax({
                    type: "post",
                    url: url,
                    data: fd,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                        toastr.success("Thêm mới nhân viên thành công!");
                        $("#modal-supplier-add").modal('hide');
                        location.reload();

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        toastr.error("Thêm mới nhân viên thất bại!");
                    },
                });
            });

            $("#form-employee-edit").submit(function(e) {
                e.preventDefault();
                var form = $('#form-employee-edit')[0]; // You need to use standard javascript object here
                var formData = new FormData(form);
                var url = $(this).attr("action");
                $.ajax({
                    type: "post",
                    url: url,
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        toastr.success("Cập nhật nhân viên thành công!");
                        $("#modal-employee-edit").modal('hide');
                        location.reload();
                        console.log(response);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        toastr.error(
                            "Cập nhật nhân viên thất bại!");
                    },
                });
            });

            $(".btn-delete").click(function() {
                var url = $(this).attr("data-url");
                if (confirm("Bạn có chắc muốn xóa không?")) {
                    $.ajax({
                        type: "get",
                        dataType: "json",
                        url: url,
                        success: function() {
                            toastr.success("Xóa nhân viên này thành công!");
                            location.reload();
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            toastr.error("Xóa nhân viên này thất bại!");
                        },
                    });
                }
            });
            $('.btn-edit').click(function(e) {
                var url = $(this).attr('data-url');
                $('#modal-employee-edit').modal('show');
                e.preventDefault();
                $.ajax({
                    type: 'get',
                    url: url,
                    success: function(response) {
                        $("#UserID").val(response.employee_get[0].UserID);

                        $("#employee-name-edit").val(response.employee_get[0].UserName);
                        $("#employee-phone-edit").val(response.employee_get[0].PhoneNumber);
                        $("#employee-address-edit").val(response.employee_get[0].Address);
                        $("#employee-email-edit").val(response.employee_get[0].Email);
                        $("#image_preview_container1234").attr('src',
                            'http://127.0.0.1:8000/admin/img/' + response.employee_get[0]
                            .Image);
                        $("#emp_img").val(response.employee_get[0].Image);
                        $('#form-employee-edit').attr('action',
                            '{{ asset('update-employee/') }}/' + response.employee_get[0]
                            .UserID);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {

                    }
                })
            });
        });
    </script>
@endsection
