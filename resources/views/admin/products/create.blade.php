@extends('admin.layouts.app')

@section('content')
    <form method="POST" novalidate action="/products" enctype="multipart/form-data">
        @csrf
        <h2 class="text-info">Thêm mới sản phẩm</h2>
        <hr>
            <ul class="nav nav-tabs">
            <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#thongtinchung"><i class="fas fa-info-circle"></i> Thông tin chung</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#thongtinchitiet"><i class="fas fa-info"></i> Thông tin chi tiết</a>
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
                                            <input name="ProductCode" class="form-control">
                                        </div>
                                    </div>
                
                                    <div class="form-group col-md-6">
                                        <label class="control-label col-md">Tên sản phẩm</label>
                                        <div class="col-md">
                                            <input name="ProductName" class="form-control">
                                        </div>
                                    </div>
                                    
                                </div>
                
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label col-md">Phân loại sản phẩm</label>
                                        <div class="col-md">
                                            <select readonly name="CategoryID" class="form-control">
                                                @foreach ($categorys as $item)
                                                    <option value="{{ $item->CategoryID }}" @selected($item->CategoryID == $categoryID)>{{ $item->ProductCategoryName }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                
                                    <div class="form-group col-md-6">
                                        <label class="control-label col-md">Thương hiệu</label>
                                        <div class="col-md">
                                            <select name="BrandID" class="form-control">
                                                @foreach ($brands as $item)
                                                    <option value="{{ $item->BrandID }}">{{ $item->BrandName }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label col-md">Giá bán</label>
                                        <div class="col-md">
                                            <input name="Price" type="number" name="Price" class="form-control">
                                        </div>
                                    </div>
                
                                    <div class="form-group col-md-6">
                                        <label class="control-label col-md">Giá nhập</label>
                                        <div class="col-md">
                                            <input name="OutwardPrice" type="number" name="PriceOutWard" class="form-control">
                                        </div>
                                    </div>
                                </div>
                
                                <div class="form-group" id="product_price">
                                    <label class="control-label col-md">Số lượng</label>
                                    <div class="col-md">
                                        <input name="Amount" min="0" type="number" class="form-control">
                                    </div>
                                    {{-- <b class="text-warning col-md">Nếu sản phẩm có phân loại số lượng sẽ được lấy theo số lượng của từng sản phẩm</b> --}}
                                </div>
                            </div>
                
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label col-md">Hình ảnh</label>
                                    <div class="card border-info shadow-sm">
                                        <div class="card-header">Cập nhật hình ảnh cho sản phẩm</div>
                                        <div class="card-body">
                                            <div class="text-center">
                                                <img width="250" height="250" src="http://127.0.0.1:8000/admin/img/productDefaut.png" class="avatar  img-thumbnail " alt="avatar">
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

                        <div class="form-group">
                            <label class="control-label col-md">Miêu tả</label>
                            <div class="col-md">
                                <textarea rows="20" class="ckeditor" id="editor" name="ProductDescription" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="col-md">
                            <div class="custom-control custom-switch ">
                                <input checked="true" name="Active" type="checkbox" class="custom-control-input" id="switch1" name="example">
                                <label class="custom-control-label" for="switch1">Trạng thái</label>
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
                        @foreach ($attributes as $item)
                            <div class="form-group">
                                <label class="control-label col-md">{{ $item->AttributeName }}</label>
                                <div class="col-md">
                                    <input class = "form-control" type="text" name="AttributeValue[]" type="text" required>
                                </div>
                            </div>
                        @endforeach
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
        $('[data-toggle="tooltip"]').tooltip();

        $(".nav-2").addClass("show");

        $('.nav-link-2').removeClass('collapsed');
        
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
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
    
</script>
@endsection