@extends('layouts.app')

@section('content')
    <form method="PUT" novalidate action="/products" enctype="multipart/form-data">
        @csrf
        <h2 class="text-info">Cập nhật sản phẩm</h2>
        <hr>
            <ul class="nav nav-tabs">
            <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#thongtinchung"><i class="fas fa-info-circle"></i> Thông tin chung</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#thongtinchitiet"><i class="fas fa-info"></i> Thông tin chi tiết</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#phanloaisanpham"><i class="fas fa-th"></i> Phân loại sản phẩm</a>
            </li>
        </ul>
    
        <!-- Tab panes -->
        <div class="tab-content">
            {{-- Thông tin chung --}}
            <div class="tab-pane active" id="thongtinchung">
                <div class="card shadow mt-4 mb-4 border-left-info">
                    <div class="card-header py-2" >
                        <div class="float-left mt-2">
                            <h5 class="m-0 font-weight-bold text-primary">Thông tin chung</h5>
                        </div>
                    </div>
            
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8 info_product">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label col-md">Mã sản phẩm</label>
                                        <div class="col-md">
                                            <input name="ProductCode" class="form-control" value="{{ $product->ProductCode }}">
                                        </div>
                                    </div>
                
                                    <div class="form-group col-md-6">
                                        <label class="control-label col-md">Tên sản phẩm</label>
                                        <div class="col-md">
                                            <input name="ProductName" class="form-control" value="{{ $product->ProductName }}">
                                        </div>
                                    </div>
                                    
                                </div>
                
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label col-md">Loại sản phẩm</label>
                                        <div class="col-md">
                                            <select name="CategoryID" class="form-control">
                                                @foreach ($categorys as $item)
                                                    <option value="{{ $item->CategoryID }}" @selected($item->CategoryID == $product->CategoryID)>{{ $item->ProductCategoryName }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                
                                    <div class="form-group col-md-6">
                                        <label class="control-label col-md">Thương hiệu</label>
                                        <div class="col-md">
                                            <select name="BrandID" class="form-control">
                                                @foreach ($brands as $item)
                                                    <option value="{{ $item->BrandID }}" @selected($item->BrandID == $product->BrandID)>{{ $item->BrandName }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label col-md">Giá bán</label>
                                        <div class="col-md">
                                            <input value="{{ $product->Price }}" name="Price" type="number" name="Price" class="form-control">
                                        </div>
                                    </div>
                
                                    <div class="form-group col-md-6">
                                        <label class="control-label col-md">Giá nhập</label>
                                        <div class="col-md">
                                            <input value="{{ $product->OutwardPrice }}" name="OutwardPrice" type="number" name="PriceOutWard" class="form-control">
                                        </div>
                                    </div>
                                </div>
                
                                <div class="form-group">
                                    <label class="control-label col-md">Miêu tả</label>
                                    <div class="col-md">
                                        <textarea name="ProductDescription" class="form-control">{{ $product->ProductDescription }}</textarea>
                                    </div>
                                </div>
                
                                <div class="form-group" id="product_price">
                                    <label class="control-label col-md">Số lượng</label>
                                    <div class="col-md">
                                        <input value="{{ $product->Amount }}" name="Amount" min="0" type="number" class="form-control">
                                    </div>
                                    <b class="text-warning col-md">Nếu sản phẩm có phân loại số lượng sẽ được lấy theo số lượng của từng sản phẩm</b>
                                </div>
                            </div>
                
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label col-md">Hình ảnh</label>
                                    <div class="card border-info shadow-sm">
                                        <div class="card-header">Cập nhật hình ảnh cho sản phẩm</div>
                                        <div class="card-body">
                                            <div class="text-center">
                                                @if ($product->Image)
                                                    <img width="250" height="250" src="http://127.0.0.1:8000/imgProduct/{{$product->Image}}" class="avatar  img-thumbnail " alt="avatar">
                                                @else
                                                    <img width="250" height="250" src="http://127.0.0.1:8000/img/productDefaut.png" class="avatar  img-thumbnail " alt="avatar">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="custom-file">
                                                <input type="file" name="ImageFile" id="customFile" class="text-center center-block file-upload custom-file-input">
                                                <label class="custom-file-label loadtext" for="customFile">Chọn file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                
                        </div>
                    </div>
                </div>
            </div>

            {{-- Thông tin chi tiết --}}
            <div class="tab-pane fade" id="thongtinchitiet">
                <div class="card shadow mt-4 mb-4 border-left-info">
                    <div class="card-header py-2">
                        <div class="float-left mt-2">
                            <h5 class="m-0 font-weight-bold text-primary">Thông tin chi tiết</h5>
                        </div>
                    </div>
                
                    <div class="card-body">
                        @for ($i = 0; $i < count($variations); $i++)
                            <div class="form-group">
                                <label class="control-label col-md">{{ $variations[$i]->VariationName }}</label>
                                <div class="col-md">
                                    <input value="{{$attributevalues[$i]->Value}}" class = "form-control" type="text" name="AttributeValue[]" type="text" required>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>

            {{-- Phân loại sản phẩm --}}
            <div class="tab-pane fade" id="phanloaisanpham">
                {{-- Nhóm phân loại 1 --}}
                <div class="card shadow mt-4 mb-4 border-left-info">
                    <div style="cursor: pointer" class="card-header py-2 collapsed" data-toggle="collapse" data-target="#nhomphanloai1" aria-expanded="true">
                        <div class="float-left mt-2">
                            <h5 class="m-0 font-weight-bold text-primary">Nhóm phân loại 1</h5>
                        </div>
                    </div>
                    <div id="nhomphanloai1"  class="collapse show">
                        <div class="card-body">
                            <div class="form-group">
                                <label class="control-label">Tên nhóm phân loại</label>
                                <div>
                                    <input required name="VariationName1" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>          
                                                <th class="text-center">
                                                    Giá trị
                                                </th>
                                                <td class="text-center" width="8%">
                                                    Thao tác
                                                </td>
                                            </tr>
                                        </thead>
                        
                                        <tbody id="list_value1">
                                            <tr>
                                                <td>
                                                    <input name="Value[]" class="form-control variationoption">
                                                </td>
                                                <td class="text-center">
                                                    <a class="addRow btn btn-sm btn-primary" data-toggle="tooltip" title="Thêm dòng"> <i class="fas fa-plus-circle"></i></a>
                                                    {{-- <a class="delete btn btn-sm btn-danger" data-toggle="tooltip" title="Xóa"> <i class="far fa-trash-alt"></i></a> --}}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Nhóm phân loại 2 --}}
                <div class="card shadow mt-4 mb-4 border-left-info">
                    <div style="cursor: pointer" class="card-header py-2 collapsed" data-toggle="collapse" data-target="#nhomphanloai2" aria-expanded="true">
                        <div class="float-left mt-2">
                            <h5 class="m-0 font-weight-bold text-primary">Nhóm phân loại 2</h5>
                        </div>
                    </div>
                    <div id="nhomphanloai2"  class="collapse">
                        <div class="card-body">
                            <div class="form-group">
                                <label class="control-label">Tên nhóm phân loại</label>
                                <div>
                                    <input name="VariationName2" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>          
                                                <th class="text-center">
                                                    Giá trị
                                                </th>
                                                <td class="text-center" width="8%">
                                                    Thao tác
                                                </td>
                                            </tr>
                                        </thead>
                        
                                        <tbody id="list_value2">
                                            <tr>
                                                <td>
                                                    <input name="Value2[]" class="form-control variationoption2">
                                                </td>
                                                <td class="text-center">
                                                    <a class="addRow2 btn btn-sm btn-primary" data-toggle="tooltip" title="Thêm dòng"> <i class="fas fa-plus-circle"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Danh sách phân loại hàng --}}
                <div class="card shadow mt-4 mb-4 border-left-info">
                    <div style="cursor: pointer" class="card-header py-2 collapsed" data-toggle="collapse" data-target="#danhsachphanloai" aria-expanded="true">
                        <div class="float-left mt-2">
                            <h5 class="m-0 font-weight-bold text-primary">Danh sách phân loại hàng</h5>
                        </div>
                    </div>
                    <div id="danhsachphanloai"  class="collapse show">
                        <div class="card-body">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">Thiết lập nhanh</span>
                                </div>
                                <input type="number" class="form-control" id="priceApply" placeholder="Giá bán">
                                <input type="number" class="form-control" id="amountApply" placeholder="Số lượng">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" id="applyAll" type="button">Áp dụng cho tất cả phân loại</button>
                                  </div>
                            </div>

                            <table class="table table-bordered" width="100%" cellspacing="0" id="list_variation">
                                {{-- Render giá trị --}}
                            </table>

                            <div class="row" id="listImage">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-4 d-flex justify-content-between"> 
            <a href="{{URL::to('/products') }}" class="btn btn-primary"><i class="fas fa-undo"></i> Quay lại</a>
            <button class="btn btn-success" type="submit"><i class="far fa-save"></i> Lưu</button>
        </div>
    </form>
@endsection

@section('scripts')
<script>
    /**
     * Upload ảnh lên giao diện khi chọn file
    **/
    $(document).ready(function () {
        $(".custom-file-input").on("change", function () {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

        var readURL = function (input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.avatar').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }


        $(".file-upload").on('change', function () {
            readURL(this);
        });
    });

    $(document).on('change', '.img-upload', function () {
        var i = $(this).attr('data-id');
        let reader = new FileReader();

        reader.onload = (e) => {
            $(`.product_img_${i}`).attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });

    /**
     * Thêm dòng trên table
    **/
    $(document).ready(function () {
        $('.addRow').click(function (e) { 
            e.preventDefault();
            var html = '';
            html += '<tr><td><input name="Value[]" class="form-control variationoption"></td>'
            html += '<td class="text-center"><a class="deleteRow btn btn-sm btn-danger" data-toggle="tooltip" title="Xóa"> <i class="far fa-trash-alt"></i></a> </td></tr>';    
            $('#list_value1').append(html);
        });

        $('.addRow2').click(function (e) { 
            e.preventDefault();
            var html = '';
            html += '<tr><td><input name="Value2[]" class="form-control variationoption2"></td>'
            html += '<td class="text-center"><a class="deleteRow btn btn-sm btn-danger" data-toggle="tooltip" title="Xóa"> <i class="far fa-trash-alt"></i></a> </td></tr>';    
            $('#list_value2').append(html);
        });

        
    });

    /**
     * Xóa dòng trên table
    **/
    $(document).on('click','.deleteRow', function () {
        $(this).closest('tr').remove();
    });

    /**
     * Sự kiện khi án nút áp dụng cho tất cả các phân loại
    **/
    $(document).on('click', '#applyAll', function () {
        var priceApply = $('#priceApply').val();
        var amountApply = $('#amountApply').val();

        $('.price').each(function () { 
            $(this).val(priceApply);
        });

        $('.amount').each(function () { 
            $(this).val(amountApply);
        });
    });

    /**
    * Render bảng danh sách các phân loại
    **/
    $(document).on('change', "input[name='Value[]'],input[name='Value2[]'],input[name='VariationName1'],input[name='VariationName2']", function() {
        var variationoption = [];
        var variationoption2 = []
        var totalvariation;
        var variationname1 = $('input[name="VariationName1"]').val();
        var variationname2 = $('input[name="VariationName2"]').val();

        $(".variationoption").each(function () { 
            if ($(this).val())
                variationoption.push($(this).val());
        });

        $(".variationoption2").each(function () { 
            if ($(this).val())
                variationoption2.push($(this).val());
        });
        if ((variationname1 || variationoption.length > 0) || (variationname2 || variationname2.length > 0)) {
            $('#product_price').remove();
        }
        else {
            $('.info_product').append('<div class="form-group" id="product_price"> <label class="control-label col-md">Số lượng</label> <div class="col-md"> <input min="0" type="number" class="form-control"> </div> <b class="text-warning col-md">Nếu sản phẩm có phân loại số lượng sẽ được lấy theo số lượng của từng sản phẩm</b> </div>');
        }

        $('#list_variation').empty();
        var html = '<thead><tr>';
        if (variationoption.length > 0) {
            html += '<th>'+ variationname1 +'</th>';
        }
        if (variationoption2.length > 0) {
            html += '<th>'+ variationname2 +'</th>';
        }
        html += '<th>Giá bán</th>';
        html += '<th>Số lượng</th>';
        html += '<th>Hình ảnh</th>';
        html += '</tr></thead>';
        html += '<tbody>';
        if (variationoption.length > 0 && variationoption2.length > 0) {
            var index = 1
            for (var i =0; i < variationoption.length; i++) {
                for (var y=0; y < variationoption2.length; y++) {
                    html += '<tr>'
                    html += '<td>' + variationoption[i] + '</td>'
                    html += '<td>' + variationoption2[y] + '</td>'
                    html += '<td>' + '<input type="number" name="price[]" placeholder="Giá bán" class="form-control price">' +' </td>'
                    html += '<td>' + '<input type="number" name="amount[]" placeholder="Số lượng" class="form-control amount">' +' </td>'
                    html += '<td  style="max-width: 120px;">';
                    html += '<img src="http://127.0.0.1:8000/img/productDefaut.png" class="img-thumbnail product_img_' + index + '" alt="avatar">';            
                    html += '<input type="file" name="ImageFiles[]" data-id="' + index + '" class="text-center center-block img-upload form-control-sm">';
                    html += '</td>';
                    html += '</tr>'
                    index++;
                }
            }
        }
        else if (variationoption.length > 0) {
            for (var i =0; i < variationoption.length; i++) {
                    html += '<tr>'
                    html += '<td>' + variationoption[i] + '</td>'
                    html += '<td>' + '<input type="number" name="price[]" placeholder="Giá bán" class="form-control price">' +' </td>'
                    html += '<td>' + '<input type="number" name="amount[]" placeholder="Số lượng" class="form-control amount">' +' </td>'
                    html += '<td  style="max-width: 120px;">';
                    html += '<img src="http://127.0.0.1:8000/img/productDefaut.png" class="img-thumbnail product_img_' + i + '" alt="avatar">';            
                    html += '<input type="file" name="ImageFiles[]" data-id="' + i + '" class="text-center center-block img-upload form-control-sm">';
                    html += '</td>';
                    html += '</tr>'
            }
        }
        else if (variationoption2.length > 0) {
            for (var i =0; i < variationoption2.length; i++) {
                    html += '<tr>'
                    html += '<td>' + variationoption2[i] + '</td>'
                    html += '<td>' + '<input type="number" name="price[]" placeholder="Giá bán" class="form-control price">' +' </td>'
                    html += '<td>' + '<input type="number" name="amount[]" placeholder="Số lượng" class="form-control amount">' +' </td>'
                    html += '<td  style="max-width: 120px;">';
                    html += '<img src="http://127.0.0.1:8000/img/productDefaut.png" class="img-thumbnail product_img_' + i + '" alt="avatar">';            
                    html += '<input type="file" name="ImageFiles[]" data-id="' + i + '" class="text-center center-block img-upload form-control-sm">';
                    html += '</td>';
                    html += '</tr>'
            }
        }
        html += '</tbody>';
        
        $('#list_variation').append(html);
        
    })

    
</script>
@endsection