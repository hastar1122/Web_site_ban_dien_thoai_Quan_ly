@extends('layouts.app')

@section('content')
<h2 class="text-info">Thêm mới sản phẩm</h2>

<form method="POST" >
    <div class="card shadow mb-4 border-left-info">
        <div style="cursor: pointer"  class="card-header py-2 collapsed" data-toggle="collapse" href="#thongtinchung" aria-expanded="true" aria-controls="thongtinchung">
            <div class="float-left mt-2">
                <h5 class="m-0 font-weight-bold text-primary">Thông tin chung</h5>
            </div>
        </div>
    
        <div id="thongtinchung" class="collapse show">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="control-label col-md">Mã sản phẩm</label>
                                <div class="col-md">
                                    <input class="form-control">
                                </div>
                            </div>
        
                            <div class="form-group col-md-6">
                                <label class="control-label col-md">Tên sản phẩm</label>
                                <div class="col-md">
                                    <input class="form-control">
                                </div>
                            </div>
                            
                        </div>
        
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="control-label col-md">Loại sản phẩm</label>
                                <div class="col-md">
                                    <select class="form-control">
                                        @foreach ($categorys as $item)
                                            <option value="{{ $item->CategoryID }}">{{ $item->ProductCategoryName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
        
                            <div class="form-group col-md-6">
                                <label class="control-label col-md">Thương hiệu</label>
                                <div class="col-md">
                                    <select class="form-control">
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
                                    <input class="form-control">
                                </div>
                            </div>
        
                            <div class="form-group col-md-6">
                                <label class="control-label col-md">Giá nhập</label>
                                <div class="col-md">
                                    <input class="form-control">
                                </div>
                            </div>
                        </div>
        
                        <div class="form-group">
                            <label class="control-label col-md">Miêu tả</label>
                            <div class="col-md">
                                <textarea class="form-control"></textarea>
                            </div>
                        </div>
        
                        <div class="form-group">
                            <label class="control-label col-md">Số lượng</label>
                            <div class="col-md">
                                <input min="0" type="number" class="form-control">
                            </div>
                        </div>
                    </div>
        
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label col-md">Hình ảnh</label>
                            <div class="card border-info shadow-sm">
                                <div class="card-header">Cập nhật hình ảnh cho sản phẩm</div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <img width="250" height="250px" src="~/Images/GiangVien/avatar_2x.png" class="avatar  img-thumbnail " alt="avatar">
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
    
    <div style="cursor: pointer"  class="card shadow mb-4 border-left-info">
        <div class="card-header py-2 collapsed" data-toggle="collapse" href="#thongtinchitiet" aria-expanded="true" aria-controls="thongtinchitiet" >
            <div class="float-left mt-2">
                <h5 class="m-0 font-weight-bold text-primary">Thông tin chi tiết</h5>
            </div>
        </div>
    
        <div id="thongtinchitiet" class="collapse show">
            <div class="card-body">
                @foreach ($variations as $item)
                    <div class="form-group">
                        <label class="control-label col-md">{{ $item->VariationName }}</label>
                        <div class="col-md">
                            <input class = "form-control" type="text" id="VariationName" name="VariationName" type="text" required>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Phân loại sản phẩm --}}
    <div style="cursor: pointer"  class="card shadow mb-4 border-left-info">
        <div class="card-header py-2 collapsed" data-toggle="collapse" href="#thongtinchitiet" aria-expanded="true" aria-controls="phanloaisanpham" >
            <div class="float-left mt-2">
                <h5 class="m-0 font-weight-bold text-primary">Phân loại sản phẩm</h5>
            </div>
        </div>
    
        <div id="phanloaisanpham" class="collapse show">
            <div class="card-body">
                @foreach ($variations as $item)
                    <div class="form-group">
                        <label class="control-label col-md">{{ $item->VariationName }}</label>
                        <div class="col-md">
                            <input class = "form-control" type="text" id="VariationName" name="VariationName" type="text" required>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- footer --}}
    <div class="mb-4 d-flex justify-content-between"> 
        <button class="btn btn-primary"><i class="fas fa-undo"></i> Quay lại</button>
        <button class="btn btn-success" type="submit"><i class="far fa-save"></i> Lưu</button>
    </div>
</form>

@endsection

@section('scripts')
<script>
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

        var readURL2 = function (input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.avatar2').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }


        $(".file-upload2").on('change', function () {
            readURL2(this);
        });
    });
</script>
@endsection