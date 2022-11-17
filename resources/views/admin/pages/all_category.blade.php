@extends('admin.layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Danh Mục Loại Sản Phẩm</h1>
        <div class="d-flex justify-content-end">
            <div class="input-group" style="width:260px;">
                <form  action="" class="form-inline" >
                    <input type="search" class="form-control  rounded" name="category_search" id="category-search" 
                        aria-label="Search" aria-describedby="search-addon" required/>
                    <button type="submit" class="btn btn-outline-primary btn-search"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
        <br>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-1 font-weight-bold text-primary">Danh sách Loại Sản Phẩm</h6>
                <a href="#" data-url="{{ URL::to('/show-category') }}" class="btn btn-light btn-outline-primary btn-add" data-toggle="modal"   data-target="#modal-category-add">
                    <i class="fas fa-plus-circle fa-lg"></i>&nbsp;Thêm loại sản phẩm</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Mã loại</th>
                                <th>Tên loại</th>
                                <th>Của loại</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_category_get as $category)
                            <tr>
                                <td>{{ $category->CategoryID }}</td>
                                <td>{{ $category->ProductCategoryName }}</td>
                                <td>{{ $category->CategoryParent }}</td>
                                <td>
                                    <a data-url="{{ URL::to('/edit-category/' .  $category->CategoryID) }}" type="button"
                                        class="btn btn-info btn-edit"><i class="fas fa-edit"></i></a>
                                    <a data-url="{{ URL::to('/delete-category/' .  $category->CategoryID) }}" type="button"
                                        class="btn btn-danger btn-delete"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
            </div>
            <div style="margin-left:17px;">
                {{ $all_category_get->appends(request()->all())->links() }}
            </div>
        </div>

    </div>
    @include('admin.pages.category.add')
    @include('admin.pages.category.edit')

    <script type="text/javascript">
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();

            $(".nav-1").addClass("show");

            $('.nav-link-1').removeClass('collapsed');
            
            $('.btn-add').click(function(e) {
                var url = $(this).attr('data-url');
                $('#modal-category-add').modal('show');
                e.preventDefault();
                $.ajax({
                    type: 'get',
                    url: url,
                    success: function(response) {
                        $("#category-parent-add").empty();
                        $("#category-parent-add").append('<option value="">Không có</option>');
                        for (var i = 0; i < response.data.length; i++) {
                            $("#category-parent-add").append('<option value=' + response.data[i]
                                .CategoryID + '>' + response.data[i].ProductCategoryName + '</option>');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {}
                })
            });

            $("#form-category-add").submit(function(e) {
                e.preventDefault();
                var url = $(this).attr("data-url");
                $.ajax({
                    type: "post",
                    url: url,
                    data: {
                        categoryname: $("#category-name-add").val(),
                        categoryparent: $("#category-parent-add").val(),
                    },
                    success: function(response) {
                        toastr.success("Thêm mới loại sản phẩm thành công!");
                        $("#modal-category-add").modal('hide');
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        toastr.error("Loại sản phẩm không được trùng nhau","Thêm mới loại sản phẩm thất bại!");
                    },
                });
            });

            $("#form-category-edit").submit(function(e) {
                e.preventDefault();
                var url = $(this).attr("action");
                $.ajax({
                    type: "post",
                    url: url,
                    data: {
                        category_name: $("#category-name-edit").val(),      
                        category_parent: $("#category-parent-edit").val(),
                    },
                    success: function(response) {
                        toastr.success("Cập nhật loại sản phẩm thành công!");
                        $("#modal-category-edit").modal('hide');
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        toastr.error("Loại sản phẩm không được trùng nhau hoặc chưa thay đổi","Cập nhật loại sản phẩm thất bại!",);
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
                            toastr.success("Xóa loại sản phẩm này thành công!");
                            location.reload();
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            toastr.error("Xóa loại sản phẩm con trước","Xóa loại sản phẩm này thất bại!");
                        },
                    });
                }
            });
            $('.btn-edit').click(function(e) {
                var url = $(this).attr('data-url');
                $('#modal-category-edit').modal('show');
                e.preventDefault();
                $.ajax({
                    type: 'get',
                    url: url,
                    success: function(response) {
                        $("#category-name-edit").val(response.category_get[0].ProductCategoryName);
                        $("#category-parent-edit").empty();
                        $("#category-parent-edit").append(
                            '<option value="">Không có</option>');
                        for (var i = 0; i < response.data.length; i++) {
                            if (response.category_get[0].CategoryID != response.data[i].CategoryID) {
                                $("#category-parent-edit").append('<option value=' + response.data[
                                        i]
                                    .CategoryID + '>' + response.data[i].ProductCategoryName +
                                    '</option>');
                            }
                        }
                        $('#category-parent-edit').val(response.category_get[0].CategoryParentID).attr(
                            "selected", "selected");
                        $('#form-category-edit').attr('action',
                            '{{ asset('update-category/') }}/' + response.category_get[0].CategoryID);

                    },
                    error: function(jqXHR, textStatus, errorThrown) {}
                })
            });
        });
    </script>
@endsection
