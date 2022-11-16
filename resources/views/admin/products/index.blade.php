@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md float-left">

        <div class="form-inline">
            <select data-url="{{ URL::to('/loadProducts') }}" id="category" required class="form-control col-md-4">
                <option value="">--Chọn phân loại sản phẩm--</option>
                @foreach ($categorys as $item)
                    <option value="{{ $item->CategoryID }}">{{ $item->ProductCategoryName }}</option>
                @endforeach
            </select>
            <select data-url="{{ URL::to('/loadProducts') }}" id="brand" required class="form-control col-md-4 ml-md-3">
                <option value="">--Chọn thương hiệu--</option>
                @foreach ($brands as $item)
                    <option value="{{ $item->BrandID }}">{{ $item->BrandName }}</option>
                @endforeach
            </select>
        </div>

    </div>
    <div class=" float-right mr-2">
        <a class="export btn btn-success"><i class="fas fa-download"></i> Export Excel</a>
        <a class="btn btn-primary" data-toggle="modal" data-target="#importModal"><i class="fas fa-upload"></i> Import Excel</a>
    </div>
</div>
<hr />

<div class="card shadow mb-4 border-left-info">
    <div class="card-header py-3">
        <div class="float-left mt-2">
            <h5 class="m-0 font-weight-bold text-primary">Danh sách các sản phẩm</h5>
        </div>
        <div class="float-right mb-n3">
            <a data-toggle="modal" href="#addModal" class="btn btn-primary mb-3 btn-icon-split">
                <span class="icon text-white">
                    <i class="fas fa-plus-circle"></i>
                </span>
                <span class="text">Thêm mới</span>
            </a>
        </div>
    </div>
    
    <div class="card-body LoadAllProduct">
        @include('admin.products.listProduct')
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
                <h4 class="modal-title text-info">Thêm mới sản phảm</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="products/create" method="GET">
                @csrf
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">Phân loại sản phẩm</label>
                        <select required name="CategoryID" class="form-control col-md">
                            @foreach ($categorys as $item)
                                <option value="{{ $item->CategoryID }}">{{ $item->ProductCategoryName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Loại sản phẩm</label>
                        <select required name="Type" class="form-control col-md">
                            <option value="1">Sản phẩm bình thường</option>
                            <option value="2">Sản phẩm có nhiều phân loại</option>
                        </select>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <div class="form-actions no-color">
                        <button type="submit" value="Thêm" class="btn btn-outline-primary "> <i class="fas fa-check"></i> Xác nhận </button>
                    </div>

                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal"> <i class="fas fa-times"></i> Thoát </button>
                </div>
            </form>
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
                <h6 class="text text-primary text-wr">Bạn có chắc chắn muốn xóa sản phẩm này không ?</h6>
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

        // Lọc danh sách sản phẩm
        $('#category, #brand').on('change', function () {
            LoadProducts();
        });

        // Load danh sách sản phẩm
        function LoadProducts() {
            var category = $('#category').val();
            var brand = $('#brand').val();
            var url = $(this).attr('data-url');
            $('#dataTable').DataTable().clear();
            $('.table-responsive').remove();
            $.ajax({
                url: 'http://127.0.0.1:8000/loadProducts',
                data: { category: category, brand: brand },
                dataType: "html",
                type: 'GET',
                success: function (data) {
                    $('.LoadAllProduct').html(data);
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
            var MaSP = $(".Xoa").val();
            $.ajax({
                async: true,
                url: 'http://127.0.0.1:8000/products/'+MaSP,
                dataType: 'json',
                type: "DELETE",
                success: function (data) {
                    if (data == true) {
                        LoadProducts();
                        toastr.options.positionClass = "toast-bottom-right";
                        toastr.success("Xóa thành công");
                    }
                    if (data == false) {
                        alert("Không thể xóa sản phẩm này");
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