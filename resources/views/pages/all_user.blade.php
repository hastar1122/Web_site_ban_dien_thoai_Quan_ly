@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">Danh Mục Tài Khoản</h1>

        <br>
        <div class=" d-flex justify-content-between">
            <div class="d-flex justify-content-between">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        @if (!request()->rolename)
                            Tất cả
                        @elseif (request()->rolename)
                            {{ request()->rolename }}
                        @endif
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ URL::to('/all-user/') }}">Tất cả</a>
                        @foreach ($all_role_get as $role)
                            <a class="dropdown-item"
                                href="{{ URL::to('/all-user?rolename=' . $role->RoleName) }}">{{ $role->RoleName }} </a>
                        @endforeach
                    </div>
                </div>

            </div>
            <div class="d-flex justify-content-end">
                <div class="input-group" style="width:260px;">
                    <form action="" class="form-inline">
                        <input type="search" class="form-control  rounded" name="user_search" id="user-search"
                            placeholder="Search by account" aria-label="Search" aria-describedby="search-addon" required />
                        <button type="submit" class="btn btn-outline-primary btn-search"><i
                                class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <br>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-1 font-weight-bold text-primary">Danh sách Tài Khoản</h6>
                <a href="#" data-url="{{ URL::to('/show-role') }}" class="btn btn-light btn-outline-primary btn-add"
                    data-toggle="modal" data-target="#modal-user-add">
                    <i class="fas fa-plus-circle fa-lg"></i>&nbsp;Thêm tài khoản</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered" id="dataTable" style="font-size:14px;" width="100%"
                        cellspacing="0">
                        <thead>
                            <tr>
                                <th>Mã</th>
                                <th>Tên tài khoản</th>
                                <th>Tên người dùng</th>
                                @if (!request()->rolename)
                                    <th>Vai trò</th>
                                @endif
                                <th>Địa chỉ</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_user_get as $user)
                                <tr>
                                    <td>{{ $user->UserID }}</td>
                                    <td>{{ $user->UserAccount }}</td>
                                    <td>{{ $user->UserName }}</td>
                                    @if (!request()->rolename)
                                        <td>{{ $user->RoleName }}</td>
                                    @endif
                                    <td>{{ $user->Address }}</td>
                                    <td>{{ $user->Email }}</td>
                                    <td>{{ $user->PhoneNumber }}</td>

                                    <td>
                                        <a data-url="{{ URL::to('/edit-user/' . $user->UserID) }}" type="button"
                                            class="btn btn-info btn-edit"><i class="fas fa-edit"></i></a>
                                        <a data-url="{{ URL::to('/delete-user/' . $user->UserID) }}" type="button"
                                            class="btn btn-danger btn-delete"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div style="margin-left:17px;">
                {{ $all_user_get->appends(request()->all())->links() }}
            </div>
        </div>
    </div>
    @include('pages.user.add')
    @include('pages.user.edit')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".btn-delete").click(function() {
                var url = $(this).attr("data-url");
                if (confirm("Bạn có chắc muốn xóa không?")) {
                    $.ajax({
                        type: "get",
                        dataType: "json",
                        url: url,
                        success: function() {
                            toastr.success("Xóa tài khoản này thành công!");
                            location.reload();
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            toastr.error("Xóa tài khoản này thất bại!");
                        },
                    })
                }
            })
            $('.btn-add').click(function(e) {
                var url = $(this).attr('data-url');
                $('#modal-user-add').modal('show');
                e.preventDefault();
                $.ajax({
                    type: 'get',
                    url: url,
                    success: function(response) {
                        $("#user-role-add").empty();
                        $("#user-role-add").append('<option value="">Không có</option>');
                        for (var i = 0; i < response.data.length; i++) {
                            $("#user-role-add").append('<option value=' + response.data[i]
                                .RoleID + '>' + response.data[i].RoleName +
                                '</option>');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {}
                })
            });

            $("#form-user-add").submit(function(e) {
                e.preventDefault();
                var url = $(this).attr("data-url");
                $.ajax({
                    type: "post",
                    url: url,
                    data: {
                        userrole: $("#user-role-add").val(),
                        username: $("#user-name-add").val(),
                        useraccount: $("#user-account-add").val(),
                        useraddress: $("#user-address-add").val(),
                        userpassword: $("#user-password-add").val(),
                        useremail: $("#use-email-add").val(),
                        userphone: $("#user-phone-add").val(),
                    },
                    success: function(response) {
                        toastr.success("Thêm mới tài khoản thành công!");
                        $("#modal-brand-add").modal('hide');
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        toastr.error("Tên tài khoản không được trùng nhau",
                            "Thêm mới tài khoản thất bại!");
                    },
                });
            });
            $('.btn-edit').click(function(e) {
                var url = $(this).attr('data-url');
                $('#modal-user-edit').modal('show');
                e.preventDefault();
                $.ajax({
                    type: 'get',
                    url: url,
                    success: function(response) {
                        $("#user-name-edit").val(response.user_get[0].UserName);
                        $("#user-email-edit").val(response.user_get[0].Email);
                        $("#user-address-edit").val(response.user_get[0].Address);
                        $("#user-phone-edit").val(response.user_get[0].PhoneNumber);
                        $("#user-role-edit").empty();
                        $("#user-role-edit").append(
                            '<option value="">Không có</option>');
                        for (var i = 0; i < response.role.length; i++) {
                            $("#user-role-edit").append('<option value=' + response.role[i]
                                .RoleID + '>' + response.role[i].RoleName +
                                '</option>');

                        }
                        console.log(response.user_get[0].RoleID);
                        $('#user-role-edit').val(response.user_get[0].RoleID).attr(
                            "selected", "selected");
                        $('#form-user-edit').attr('action',
                            '{{ asset('update-user/') }}/' + response.user_get[0].UserID);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {

                    }
                })
            });

            $("#form-user-edit").submit(function(e) {
                e.preventDefault();
                var url = $(this).attr("action");
                $.ajax({
                    type: "post",
                    url: url,
                    data: {
                        brand_name: $("#brand-name-edit").val(),
                        brand_parent: $("#brand-parent-edit").val(),
                    },
                    success: function(response) {
                        toastr.success("Cập nhật thương hiệu thành công!");
                        $("#modal-brand-edit").modal('hide');
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        toastr.error("Tên thương hiệu không được trùng nhau hoặc chưa thay đổi",
                            "Cập nhật thương hiệu thất bại!");
                    },
                });
            });
        });
    </script>
@endsection
