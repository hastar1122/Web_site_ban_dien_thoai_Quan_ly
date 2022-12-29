@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md float-left">

        <div class="form-inline">
            <label class="control-label text-info mr-1">Thời gian nhập từ ngày </label>
            <div class="mr-1">
                <input name="Price" type="date" name="Price" class="form-control from_date">
            </div>
            <label class="control-label text-info mr-1"> đến ngày </label>
            <div class="mr-2">
                <input name="Price" type="date" name="Price" class="form-control to_date">
            </div>
            <button class="btn btn-primary search"><i class="fas fa-search"></i></button>
        </div>

    </div>
    <div class=" float-right mr-2">
        <a class="export btn btn-success"><i class="fas fa-download"></i> Export Excel</a>
        <a class="btn btn-primary" data-toggle="modal" data-target="#importModal"><i class="fas fa-upload"></i> Import Excel</a>
    </div>
</div>
<hr />

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="float-left mt-2">
                <h5 class="m-0 font-weight-bold text-primary">Danh sách phiếu nhập kho</h5>
            </div>

            <div class="float-right mb-n3">
                <a href="{{ URL::to('/importBill/create') }}" class="btn btn-primary mb-3 btn-icon-split">
                    <span class="icon text-white">
                        <i class="fas fa-plus-circle"></i>
                    </span>
                    <span class="text">Thêm mới</span>
                </a>
            </div>
        </div>
        <div class="card-body LoadImportBills">
            @include('admin.importBill.list_import')
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
                <h6 class="text text-primary text-wr">Bạn có chắc chắn muốn xóa phiếu nhập kho này không ?</h6>
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
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();

        $(".nav-2").addClass("show");

        $('.nav-link-2').removeClass('collapsed');

        $('.search').click(function (e) { 
            e.preventDefault();
            LoadImportBills();
        });

        // Load danh sách phiếu nhập
        function LoadImportBills() {
            var from_date = $('.from_date').val();
            var to_date = $('.to_date').val();
            var formData = new FormData;
            formData.append("from_date", from_date);
            formData.append("to_date", to_date);
            $('#dataTable').DataTable().clear();
            $('.table-responsive').remove();
            $.ajax({
                url: 'http://127.0.0.1:8000/loadImportBills',
                data: formData,
                contentType: false,
                processData: false,
                dataType: "html",
                type: 'POST',
                success: function (data) {
                    $('.LoadImportBills').html(data);
                    $('#dataTable').DataTable().draw();
                    $('[data-toggle="tooltip"]').tooltip();
                },
                error: function () {
                    alert("Đã có lỗi xảy ra");
                }
            });
        };

        // Mở modal delete sản phẩm
        $('body').on('click', '.delete', function () {
            $('#delModal').modal();
            $(".Xoa").val($(this).attr('data-id'));
        });

        // Xóa sản phẩm
        $('body').on('click', '.Xoa', function () {
            var ID = $(".Xoa").val();
            $.ajax({
                async: true,
                url: 'http://127.0.0.1:8000/importBill/'+ID,
                dataType: 'json',
                type: "DELETE",
                success: function (data) {
                    if (data == true) {
                        LoadImportBills();
                        toastr.options.positionClass = "toast-bottom-right";
                        toastr.success("Xóa thành công");
                    }
                    if (data == false) {
                        alert("Không thể xóa phiếu nhập này");
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
    });
</script>
@endsection



