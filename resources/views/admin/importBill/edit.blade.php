@extends('admin.layouts.app')

@section('content')
<a href="{{URL::to('/importBill') }}" class="btn btn-primary mb-4"><i class="fas fa-undo"></i> Quay lại</a>
<form method="POST" action="/importBill/{{ $importBill->ImportBillID }}">
    @csrf
    @method('PUT')
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
                            <option value="{{ $supplier->UserID }}" @selected($supplier->UserID == $importBill->SupplierID)>{{ $supplier->UserName }}</option>
                        @endforeach
                    </select>
                </div>
        
                <div class="form-group col-md-6">
                    <label class="control-label col-md">Số điện thoại</label>
                    <div class="col-md">
                        <input id="PhoneNumber" name="PhoneNumber" class="form-control" value="{{ $importBill->PhoneNumber }}">
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="form-group col-md-6">
                    <label class="control-label">Email</label>
                    <div >
                        <input id="Email" name="Email" class="form-control" value="{{ $importBill->Email }}">
                    </div>
                </div>
        
                <div class="form-group col-md-6">
                    <label class="control-label col-md">Địa chỉ</label>
                    <div class="col-md">
                        <input id="Address" rows="4" name="Address" class="form-control" value="{{ $importBill->Address }}">
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
                        @foreach ($importBillDetails as $importBillDetail)
                            <tr class="tr_{{$importBillDetail->ProductID}}" data-id="{{$importBillDetail->ProductID}}">
                                <td>{{ $importBillDetail->ProductCode}} <input value="{{$importBillDetail->ProductID}}" name="ProductID[]" hidden></td>
                                <td>{{ $importBillDetail->ProductName }}</td>
                                <td>
                                    @if ($importBillDetail->Image)
                                        <img width="90" height="90" src="http://127.0.0.1:8000/imgProduct/{{$importBillDetail->Image}}">
                                    @endif 
                                </td>
                                <td>
                                    <div class="">
                                        <input id="Amount_{{$importBillDetail->ProductID}}" data-id="{{$importBillDetail->ProductID}}" name="Amount[]" value={{ $importBillDetail->Amount }} min="1" type="number" class="form-control text-right Amount">
                                    </div>
                                </td>
                                <td>
                                    <div class="">
                                        <input id="OutwardPrice_{{$importBillDetail->ProductID}}" data-id="{{$importBillDetail->ProductID}}" name="OutwardPrice[]" value="{{ $importBillDetail->Price }}" min="0" type="number" class="form-control text-right OutwardPrice">
                                    </div>
                                </td>
                                <td>
                                    <p class="TotalPrice text-right" id="TotalPrice_{{$importBillDetail->ProductID}}">{{ number_format($importBillDetail->TotalPrice * 1, 0, ',', '.') }} </p>  
                                </td>
                                <td class="text-center">
                                    @php
                                        // Kiểm tra xem đã có sản phẩm nào được bán chưa 
                                        $flag = false;
                                        foreach($importBillDetail->productItems as $productItem) {
                                            if ($productItem->Status == 1) {
                                                $flag = true;
                                                break; 
                                            }
                                        }
                                    @endphp
                                    <a class="btn btn-sm btn-info" data-toggle="modal" href="#productItems_{{$importBillDetail->ProductID}}" data-id="/getProductItems/{{ $importBillDetail->ImportBillDetailID }}" data-toggle="tooltip" title="Danh sách các số Emeil đã nhập"> <i class="fas fa-info-circle"></i> </a>
                                    {{-- Nếu chưa có sản phảm nào được bán thì cho phép xóa chi tiết --}}
                                    @if ($flag == false)
                                        <a class="delete btn btn-sm btn-danger" data-id="{{$importBillDetail->ProductID}}" data-detail="{{$importBillDetail->ImportBillDetailID}}" data-toggle="tooltip" title="Xóa"> <i class="far fa-trash-alt"></i></a>
                                    @endif
                                </td>
                            </tr>
                            <tr class="tr_{{$importBillDetail->ProductID}}">
                                <td>Danh sách số EMEI mới</td>
                                <td colspan="6">
                                    <div class="">
                                        <textarea data-id="{{$importBillDetail->ProductID}}" id="Emei_{{$importBillDetail->ProductID}}" name="Emei[]" class="form-control Emei"></textarea>
                                    </div>
                                </td>
                            </tr>
                            <tr hidden id="old_amount_{{$importBillDetail->ProductID}}" data-id="{{ $importBillDetail->Amount }}"></tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-between"> 
                <h5 class="TotalAmount text-primary">Tổng tiền: {{ $importBill->TotalPrice }} VND</h5> 
                <button type="submit" class="save btn btn-primary"><i class="far fa-save"></i> Lưu </button>
            </div>
            
        </div>
    </div>

    <div id="listImportBillDetailDeleted">
        
    </div>
    <div id="listProductItemDeleted">
        
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

@foreach ($importBillDetails as $importBillDetail)
    {{-- Danh sách các product item --}}
    <div class="modal fade" id="productItems_{{$importBillDetail->ProductID}}">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title text-info">{{$importBillDetail->ProductName}}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
    
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable_{{$importBillDetail->ProductID}}" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 1%;">STT</th>
                                    <th>Số Emei</th>
                                    <th>Ngày nhập</th>
                                    <th>Trạng thái</th>
                                    <th style="width: 10%;" class="text-center">Thao tác</th>
                                </tr>
                            </thead>
                    
                            <tbody>
                                @php
                                $i = 0;
                                @endphp
                                @foreach($importBillDetail->productItems as $productItem)
                                @php
                                $i++;   
                                @endphp
                                <tr>
                                    <td class="text-center">{{ $i }}</td>
                                    <td>{{ $productItem->SKU}}</td>
                                    <td>{{ $importBill->ImportDate }}</td>
                                    <td>
                                        @if ($productItem->Status == null || $productItem->Status == 0)
                                            <span class="badge badge-success">Chưa bán</span>
                                        @else
                                            <span class="badge badge-danger">Đã bán</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($productItem->Status == null || $productItem->Status == 0)
                                            <a class="deleteProductItem btn btn-sm btn-danger" product-id="{{$productItem->ProductID}}" data-id="{{$productItem->ProductItemID}}" data-toggle="tooltip" title="Xóa"> <i class="far fa-trash-alt"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach



@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        var listProducts = [];

        // Lấy ra danh sách id của các sản phẩm trong table
        $('.Amount').each( function(index){ 
            listProducts.push($(this).attr('data-id'));
            $(`#dataTable_${$(this).attr('data-id')}`).DataTable();
        });

        //$('[data-toggle="tooltip"]').tooltip();

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
        * Xóa dòng trên table danh sách chi tiết phiếu nhập
        **/
        $(document).on('click','.delete', function () {
            var id = $(this).attr('data-id');
            var id_detail = $(this).attr('data-detail');
            for( var i = 0; i < listProducts.length; i++){ 
                if ( listProducts[i] === id) { 
                    listProducts.splice(i, 1); 
                }
            }
            $(`.tr_${id}`).remove();

            // Tạo input để lưu importbilldetail bị xóa để gửi về server
            var input = `<input hidden name="ImportBillDetailDeleted[]" value=${id_detail} class="form-control text-right">`;
            $('#listImportBillDetailDeleted').append(input);
            LoadTotalAmount();
        });

        // Xóa dòng trên danh sách emei đã nhập
        $(document).on('click','.deleteProductItem', function () {
            // Lấy ra id của productitem
            var id = $(this).attr('data-id');
            // Lấy ra id của product
            var productid = $(this).attr('product-id');
            // Cập nhật lại số lượng, thành tiền, và tổng tiền
            $(`#Amount_${productid}`).val(parseInt($(`#Amount_${productid}`).val()) - 1);
            $(`#TotalPrice_${productid}`).text(($(`#Amount_${productid}`).val() * $(`#OutwardPrice_${productid}`).val()).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
            // Tạo input để lưu productitem bị xóa để gửi về server
            var input = `<input hidden name="ProductItemDeleted[]" value=${id} class="form-control text-right">`;
            $('#listProductItemDeleted').append(input);
            // Cập nhật lại old_amount
            var oldAmount = $(`#old_amount_${productid}`).attr('data-id', parseInt($(`#old_amount_${productid}`).attr('data-id')) -1);
            // Nếu số lượng bằng 0 thì xóa cả dòng luôn
            if (parseInt($(`#Amount_${productid}`).val()) == 0) {
                $(`.tr_${productid}`).remove();
                // Xóa sản phẩm trong list luôn
                for( var i = 0; i < listProducts.length; i++){ 
                    if ( listProducts[i] === productid) { 
                        listProducts.splice(i, 1); 
                    }
                }
            }
            
            $(this).closest('tr').remove();
            LoadTotalAmount();
        });

        // Hàm xử lý khi input danh sách số Emei thay đổi
        $('body').on('change', '.Emei', function() {
            var me = this;
            var id = $(me).attr('data-id');
            var oldAmount = $(`#old_amount_${id}`).attr('data-id');
            if (oldAmount && oldAmount != undefined) {
                oldAmount = parseInt(oldAmount);
            }
            else {
                oldAmount = 0;
            }
            var emeis = $(me).val().toString().trim().split(';');

            $(`#Amount_${id}`).val(oldAmount + emeis.length);

            $(`#TotalPrice_${id}`).text(($(`#Amount_${id}`).val() * $(`#OutwardPrice_${id}`).val()).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));

            LoadTotalAmount();
        });
    }); 
</script>
@endsection