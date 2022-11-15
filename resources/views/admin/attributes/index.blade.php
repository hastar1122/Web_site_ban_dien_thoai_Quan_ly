@extends('admin.layouts.app')

@section('content')

<div class="card shadow mb-4 border-left-info">
    <div class="card-header py-3">
        <div class="float-left mt-2">
            <h5 class="m-0 font-weight-bold text-primary">Danh sách các thuộc tính</h5>
        </div>
        <div class="float-right mb-n3">
            <a href="{{ URL::to('/show-attribute-product-all/1') }}" class="btn btn-info mb-3 btn-icon-split mr-3">
                <span class="icon">
                    <i class="fas fa-list"></i>
                </span>
                <span class="text">Quản lý thuộc tính theo phân loại sản phẩm</span>
            </a>
            <a data-toggle="modal" href="#addModal" class="btn btn-primary mb-3 btn-icon-split">
                <span class="icon text-white">
                    <i class="fas fa-plus-circle"></i>
                </span>
                <span class="text">Thêm mới</span>
            </a>
        </div>
    </div>
    <div class="card-body listAttribute">
        @include('admin.attributes.listAttribute')
    </div>
    <div class="card-footer">
    </div>
</div>

<!-- The Modal -->
<div class="modal fade" id="addModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-info">Thêm mới thuộc tính</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label col-md">Tên thuộc tính</label>
                    <div class="col-md">
                        <input class="form-control" id="AttributeName">
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <div class="">
                    <button type="button" class="create btn btn-outline-success"><i class="fas fa-plus-circle"></i> Thêm mới</button>
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal"><i class="fas fa-times"></i> Đóng</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal fade" id="delModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-info">Thông báo</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <h6 class="text text-primary text-wr">Bạn có chắc chắn muốn xóa thuộc tính này không ?</h6>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <div class="form-actions no-color">
                    <button type="button" value="" data-dismiss="modal" class="Xoa btn btn-outline-danger far fa-trash-alt"> Xóa </button>
                </div>
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal"> Không </button>
            </div>

        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal fade" id="infModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-info">Thông tin ngành học</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <input hidden id="AttributeID2">
                <div class="form-group">
                    <label class="control-label col-md">Tên thuộc tính</label>
                    <div class="col-md">
                        <input class="form-control" id="AttributeName2">
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <div class="">
                    <button type="button" class="update btn btn-outline-success"><i class="far fa-edit"></i> Cập nhật</button>
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal"><i class="fas fa-times"></i> Đóng</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();

        $(".nav-2").addClass("show");

        $('.nav-link-2').removeClass('collapsed');

        // Mở modal xóa thuộc tính
        $('body').on('click', '.delete', function () {
            $('#delModal').modal();
            $(".Xoa").val($(this).attr('data-id'));
        });

        // Thêm mới thuộc tính
        $('body').on('click', '.create', function () {
            var AttributeName = $("#AttributeName").val();
            var formData = new FormData;
            formData.append("AttributeName", AttributeName);
            $.ajax({
                async: true,
                url: 'http://127.0.0.1:8000/attributes',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                type: 'POST',
                success: function (data) {
                    if (data == true) {
                        LoadAttributes();
                        toastr.options.positionClass = "toast-bottom-right";
                        toastr.success("Thêm mới thành công");
                        $('#addModal').modal('hide');
                        $("#AttributeName").val('');
                    }
                    else {
                        alert(data.status);
                        toastr.options.positionClass = "toast-bottom-right";
                        toastr.warning('Thêm mới không thành công');
                    }
                },
                error: function () {
                    toastr.options.positionClass = "toast-bottom-right";
                    toastr.warning('Thêm mới không thành công');
                }
            });
        });

        // Xóa thuộc tính
        $('body').on('click', '.Xoa', function () {
            var AttributeID = $(".Xoa").val();
            $.ajax({
                async: true,
                url: 'http://127.0.0.1:8000/attributes/'+AttributeID,
                dataType: 'json',
                type: "DELETE",
                success: function (data) {
                    if (data == true) {
                        LoadAttributes();
                        toastr.options.positionClass = "toast-bottom-right";
                        toastr.success("Xóa thành công");
                    }
                    if (data == false) {
                        alert("Không thể xóa thuộc tính này");
                        toastr.options.positionClass = "toast-bottom-right";
                        toastr.warning("Xóa không thành công");
                    }
                },
                error: function () {
                    toastr.options.positionClass = "toast-bottom-right";
                    toastr.warning('Xóa không thành công');
                }
            });
        });

        // Cập nhật thuộc tính
        $(".update").click(function () {
            var AttributeID = $("#AttributeID2").val();
            var AttributeName = $("#AttributeName2").val();
            var formData = new FormData;
            formData.append("AttributeID", AttributeID);
            formData.append("AttributeName", AttributeName);
            $.ajax({
                async: true,
                url: 'http://127.0.0.1:8000/update_attribute/',
                contentType: false,
                processData: false,
                data: formData,
                dataType: 'json',
                type: 'POST',
                success: function (data) {
                    if (data == true) {
                        LoadAttributes();
                        toastr.options.positionClass = "toast-bottom-right";
                        toastr.success("Chỉnh sửa thành công");
                        $('#infModal').modal('hide');
                    }
                    else {
                        alert(data);
                        toastr.options.positionClass = "toast-bottom-right";
                        toastr.warning('Chỉnh sửa không thành công');
                    }
                },
                error: function () {
                    toastr.options.positionClass = "toast-bottom-right";
                    toastr.warning('Chỉnh sửa không thành công');
                }

            });
        });

        // Mở modal edit thuộc tính
        $('body').on('click', '.information', function () {
            $('#infModal').modal();
            var AttributeID = $(this).attr('data-id');
            $.ajax({
                url: 'http://127.0.0.1:8000/attributes/'+ AttributeID,
                dataType: 'json',
                type: 'GET',
                success: function (data) {
                    $('#AttributeID2').val(data.data.AttributeID);
                    $('#AttributeName2').val(data.data.AttributeName);
                },
                error: function () {
                    alert("Đã có lỗi xảy ra");
                }
            });
        });

        // Load danh sách thuộc tính
        function LoadAttributes() {
            $('#dataTable').DataTable().clear();
            $('.table-responsive').remove();
            $.ajax({
                url: 'http://127.0.0.1:8000/listAttribute',
                dataType: "html",
                type: 'GET',
                success: function (data) {
                    $('.listAttribute').html(data);
                    $('#dataTable').DataTable().draw();
                    $('[data-toggle="tooltip"]').tooltip();
                },
                error: function () {
                    alert("Đã có lỗi xảy ra");
                }
            });
        };
    });
</script>
@endsection