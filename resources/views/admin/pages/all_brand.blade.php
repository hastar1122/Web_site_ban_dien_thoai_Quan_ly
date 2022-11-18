@extends('admin.layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Danh Mục Thương Hiệu</h1>
        <div class="d-flex justify-content-end">
            <div class="input-group" style="width:260px;">
                <form action="" class="form-inline">
                    <input type="search" class="form-control  rounded" name="brand_search" id="brand-search"
                        placeholder="Search by name.." aria-label="Search" aria-describedby="search-addon" required />
                    <button type="submit" class="btn btn-outline-primary btn-search"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
        <br>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-1 font-weight-bold text-primary">Danh sách Thương Hiệu</h6>
                <a href="#" data-url="{{ URL::to('/show-brand') }}" class="btn btn-light btn-outline-primary btn-add"
                    data-toggle="modal" data-target="#modal-brand-add">
                    <i class="fas fa-plus-circle fa-lg "></i>&nbsp;Thêm thương hiệu</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Mã thương hiệu</th>
                                <th>Tên thương hiệu</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_brand_get as $brand)
                                <tr>
                                    <td>{{ $brand->BrandID }}</td>
                                    <td>{{ $brand->BrandName }}</td>
                                    <td>
                                        <a data-url="{{ URL::to('/edit-brand/' . $brand->BrandID) }}" type="button"
                                            class="btn btn-info btn-edit"><i class="fas fa-edit"></i></a>
                                        <a data-url="{{ URL::to('/delete-brand/' . $brand->BrandID) }}" type="button"
                                            class="btn btn-danger btn-delete"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div style="margin-left:17px;">
                {{ $all_brand_get->appends(request()->all())->links() }}
            </div>
        </div>

    </div>

    @include('admin.pages.brand.add')
    @include('admin.pages.brand.edit')

    <script type="text/javascript">
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();

            $(".nav-1").addClass("show");

            $('.nav-link-1').removeClass('collapsed');

            $('.btn-add').click(function(e) {
                var url = $(this).attr('data-url');
                $('#modal-brand-add').modal('show');
                e.preventDefault();
                $.ajax({
                    type: 'get',
                    url: url,
                    success: function(response) {
                    },
                    error: function(jqXHR, textStatus, errorThrown) {}
                })
            });

            $("#form-brand-add").submit(function(e) {
                e.preventDefault();
                var url = $(this).attr("data-url");
                $.ajax({
                    type: "post",
                    url: url,
                    data: {
                        brandname: $("#brand-name-add").val(),
                    },
                    success: function(response) {
                        toastr.success("Thêm mới thương hiệu thành công!");
                        $("#modal-brand-add").modal('hide');
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        toastr.error(
                            "Thêm mới thương hiệu thất bại!");

                    },
                });
            });

            $("#form-brand-edit").submit(function(e) {
                e.preventDefault();
                var url = $(this).attr("action");
                $.ajax({
                    type: "post",
                    url: url,
                    data: {
                        brand_name: $("#brand-name-edit").val(),
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
                            toastr.success("Xóa thương hiệu này thành công!");
                            location.reload();
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            toastr.error(
                                "Xóa thương hiệu này thất bại!");
                        },
                    });
                }
            });
            $('.btn-edit').click(function(e) {
                var url = $(this).attr('data-url');
                $('#modal-brand-edit').modal('show');
                e.preventDefault();
                $.ajax({
                    type: 'get',
                    url: url,
                    success: function(response) {
                        $("#brand-name-edit").val(response.brand_get[0].BrandName);

                        $('#form-brand-edit').attr('action',
                            '{{ asset('update-brand/') }}/' + response.brand_get[0].BrandID);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {

                    }
                })
            });
        });
    </script>
@endsection
