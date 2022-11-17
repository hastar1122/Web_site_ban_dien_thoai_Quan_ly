@extends('admin.layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Danh Mục Nhà Cung Cấp</h1>
        <div class="d-flex justify-content-end">
            <div class="input-group" style="width:260px;">
                <form action="" class="form-inline">
                    <input type="search" class="form-control  rounded" name="supplier_search" id="supplier-search"
                        placeholder="Search by name.." aria-label="Search" aria-describedby="search-addon" required />
                    <button type="submit" class="btn btn-outline-primary btn-search"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
        <br>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-1 font-weight-bold text-primary">Danh sách nhà cung cấp</h6>
                <a href="#" class="btn btn-light btn-outline-primary btn-add"
                    data-toggle="modal" data-target="#modal-supplier-add">
                    <i class="fas fa-plus-circle fa-lg "></i>&nbsp;Thêm nhà cung cấp</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Mã nhà cung cấp</th>
                                <th>Tên nhà cung cấp</th>
                                <th>Địa chỉ</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_supplier_get as $supplier)
                                <tr>
                                    <td>{{ $supplier->UserID }}</td>
                                    <td>{{ $supplier->UserName }}</td>
                                    <td>{{ $supplier->Address }}</td>
                                    <td>{{ $supplier->Email }}</td>
                                    <td>{{ $supplier->PhoneNumber }}</td>
                                    <td>
                                        <a data-url="{{ URL::to('/edit-supplier/' . $supplier->UserID) }}" type="button"
                                            class="btn btn-info btn-edit"><i class="fas fa-edit"></i></a>
                                        <a data-url="{{ URL::to('/delete-supplier/' . $supplier->UserID) }}" type="button"
                                            class="btn btn-danger btn-delete"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div style="margin-left:17px;">
                {{ $all_supplier_get->appends(request()->all())->links() }}
            </div>
        </div>

    </div>

    @include('admin.pages.supplier.add')
    @include('admin.pages.supplier.edit')

    <script type="text/javascript">
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();

            $(".nav-1").addClass("show");

            $('.nav-link-1').removeClass('collapsed');
            
            $('.btn-add').click(function(e) {
                $('#modal-supplier-add').modal('show');
            });

            $("#form-supplier-add").submit(function(e) {
                e.preventDefault();
                var url = $(this).attr("data-url");
                $.ajax({
                    type: "post",
                    url: url,
                    data: {
                        suppliername: $("#supplier-name-add").val(),
                        address: $("#address-add").val(),
                        email: $("#email-add").val(),
                        phonenumber: $("#phone-number-add").val(),
                    },
                    success: function(response) {
                        toastr.success("Thêm mới nhà cung cấp thành công!");
                        $("#modal-supplier-add").modal('hide');
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        toastr.error("Thêm mới nhà cung cấp thất bại!");
                    },
                });
            });

            $("#form-supplier-edit").submit(function(e) {
                e.preventDefault();
                var url = $(this).attr("action");
                $.ajax({
                    type: "post",
                    url: url,
                    data: {
                        username: $("#supplier-name-edit").val(),
                        address: $("#address-edit").val(),
                        email: $("#email-edit").val(),
                        phonenumber: $("#phone-number-edit").val()
                    },
                    success: function(response) {
                        toastr.success("Cập nhật thương hiệu thành công!");
                        $("#modal-brand-edit").modal('hide');
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        toastr.error(
                            "Cập nhật thương hiệu thất bại!");
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
                            toastr.success("Xóa nhà cung cấp này thành công!");
                            location.reload();
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            toastr.error("Xóa nhà cung cấp này thất bại!");
                        },
                    });
                }
            });
            $('.btn-edit').click(function(e) {
                var url = $(this).attr('data-url');
                $('#modal-supplier-edit').modal('show');
                e.preventDefault();
                $.ajax({
                    type: 'get',
                    url: url,
                    success: function(response) {
                        $("#supplier-name-edit").val(response.supplier_get[0].UserName);
                        $("#address-edit").val(response.supplier_get[0].Address);
                        $("#email-edit").val(response.supplier_get[0].Email);
                        $("#phone-number-edit").val(response.supplier_get[0].PhoneNumber);
                        $('#form-supplier-edit').attr('action',
                            '{{ asset('update-supplier/') }}/' + response.supplier_get[0].UserID);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {

                    }
                })
            });
        });
    </script>
@endsection