@extends('admin.layouts.app')

@section('content')
<a href="{{URL::to('/importBill') }}" class="btn btn-primary mb-4"><i class="fas fa-undo"></i> Quay lại</a>
<form method="POST" action="/importBill">
    @csrf
    <div class="card shadow border-left-info mb-4">
        <div class="card-header">
            <h4 class="text-info m-0">Thông tin nhà cung cấp</h4>
        </div>
        
        <div class="card-body pb-0 info_order">
            <div class="row">
                <div class="form-group col-md-6">
                    <label class="control-label">Nhà cung cấp</label>
                    <select required readonly id="SupplierID" name="SupplierID" class="form-control">
                        <option value="">--Chọn nhà cung cấp--</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->UserID }}">{{ $supplier->UserName }}</option>
                        @endforeach
                    </select>
                </div>
        
                <div class="form-group col-md-6">
                    <label class="control-label col-md">Số điện thoại</label>
                    <div class="col-md">
                        <input id="PhoneNumber" name="PhoneNumber" class="form-control">
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="form-group col-md-6">
                    <label class="control-label">Email</label>
                    <div >
                        <input id="Email" name="Email" class="form-control">
                    </div>
                </div>
        
                <div class="form-group col-md-6">
                    <label class="control-label col-md">Địa chỉ</label>
                    <div class="col-md">
                        <textarea id="Address" rows="4" name="Address" class="form-control"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card shadow mb-4 border-left-info">
        <div class="card-header py-3">
            <div class="float-left mt-2">
                <h5 class="m-0 text-primary">Danh sách sản phẩm</h5>
            </div>
            <div class="float-right mb-n3 row">
                <div class="mr-2">
                    <a class="export btn btn-success"><i class="fas fa-download"></i> In phiếu nhập</a>
                </div>
                <a data-toggle="modal" href="#addModal" class="btn btn-primary mb-3 btn-icon-split">
                    <span class="icon text-white">
                        <i class="fas fa-plus-circle"></i>
                    </span>
                    <span class="text">Thêm mới</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered"  width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th style="width: 10%;">Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Thành tiền</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
    
                    <tbody id="DetailImportBill">
                        
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-between"> 
                <h5 class="TotalAmount text-primary">Tổng tiền:</h5> 
                <button type="submit" class="save btn btn-primary"><i class="far fa-save"></i> Lưu </button>
            </div>
            
        </div>
    </div>
</form>

<!-- The Modal -->
<div class="modal fade" id="addModal">
    <div class="modal-dialog  modal-xl modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-info">Chọn sản phẩm muốn nhập hàng</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
  
            <!-- Modal body -->
            <div class="modal-body">
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
                </div>
                <hr />
                
                <div class="card shadow mb-4 border-left-info">
                    <div class="card-header py-3">
                        <div class="float-left mt-2">
                            <h5 class="m-0 font-weight-bold text-primary">Danh sách các sản phẩm</h5>
                        </div>
                    </div>
                    
                    <div class="card-body LoadAllProduct">
                        @include('admin.importBill.listProduct')
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        var listProducts = [];

        $('[data-toggle="tooltip"]').tooltip();

        $('#dataTable2').DataTable();

        $(".nav-2").addClass("show");

        $('.nav-link-2').removeClass('collapsed');

        // Hàm load thông tin nhà cung cấp
        $('#SupplierID').change(function (e) { 
            e.preventDefault();
            var SupplierID = $("#SupplierID").val();
            var formData = new FormData();
            formData.append("SupplierID", SupplierID);
            $.ajax({
                async: true,
                url: 'http://127.0.0.1:8000/info-supplier',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                type: 'POST',
                success: function (data) {
                    if (data) {
                        $('#PhoneNumber').val(data.PhoneNumber);
                        $('#Email').val(data.Email);
                        $('#Address').val(data.Address);
                    }
                    else {
                        $('#PhoneNumber').val('');
                        $('#Email').val('');
                        $('#Address').val('');
                    }
                },
                error: function () {
                    toastr.options.positionClass = "toast-bottom-right";
                    toastr.warning('Có lỗi xảy ra');
                }
            });
        });

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
            //$('.table-responsive').remove();
            $.ajax({
                url: 'http://127.0.0.1:8000/loadProducts2',
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

        // Hàm thêm sản phẩm vào bảng danh sách các sản phẩm nhập kho
        $('body').on('click', '.addProduct', function() {
            var id = $(this).attr('data-id');
            if (listProducts.find(element => element === id)) {
                alert('Sản phẩm này đã có trong danh sách vui lòng kiểm tra lại');
                return;
            }
            $('#addModal').modal("toggle");
            $.ajax({
                url: 'http://127.0.0.1:8000/addProduct/' + $(this).attr('data-id'),
                dataType: "html",
                type: 'GET',
                success: function (data) {
                    $('#DetailImportBill').append(data);
                    listProducts.push(id);
                    LoadTotalAmount();
                },
                error: function () {
                    alert("Đã có lỗi xảy ra");
                }
            });
        });

        // Hàm xử lý khi input số lượng và giá nhập thay đổi
        $('body').on('change', '.Amount, .OutwardPrice', function() {
            var id = $(this).attr('data-id');
            
            $(`#TotalPrice_${id}`).text(($(`#Amount_${id}`).val() * $(`#OutwardPrice_${id}`).val()).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));

            LoadTotalAmount();
        });

        // Hàm load tổng tiền phiếu nhập
        function LoadTotalAmount (){
            var TotalAmount = 0;
            $('.TotalPrice').each( function(index){ 
                TotalAmount += parseFloat($(this).text().replaceAll('.','')); 
            });
            $('.TotalAmount').text('Tổng tiền: ' + TotalAmount.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.") + ' VND')
        }

        /**
        * Xóa dòng trên table
        **/
        $(document).on('click','.delete', function () {
            var id = $(this).attr('data-id');
            for( var i = 0; i < listProducts.length; i++){ 
                if ( listProducts[i] === id) { 
                    listProducts.splice(i, 1); 
                }
            }
            $(`.tr_${id}`).remove();
            LoadTotalAmount();
        });

        // Hàm xử lý khi input danh sách số Emei thay đổi
        $('body').on('change', '.Emei', function() {
            var id = $(this).attr('data-id');

            var emeis = $(this).val().toString().trim().split(';');

            $(`#Amount_${id}`).val(emeis.length);

            $(`#TotalPrice_${id}`).text(($(`#Amount_${id}`).val() * $(`#OutwardPrice_${id}`).val()).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));

            LoadTotalAmount();
        });

        // Hàm xử lý khi click nút lưu
        // $('.save').click(function (e) { 
        //     e.preventDefault();
        //     var detail = [];
        //     if (!listProducts.length) {
        //         alert('Vui lòng nhập ít nhất 1 sản phẩm');
        //     }

        //     listProducts.forEach(id => {
                
        //     });
        // });
    }); 
</script>
@endsection