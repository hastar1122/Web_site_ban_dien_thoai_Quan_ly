@extends('admin.layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800" style="color: #36b9cc!important">Quản lý thuộc tính theo phân loại sản phẩm</h1>
        <div class="d-flex row">
            <div class="col-md float-left">
                <div class="form-inline">
                    <select class="form-control col-md-4 btn-change-product" id="dropdownProduct" url-data="{{ URL::to('/show-table-attr') }}">
                        @foreach ($all_category as $key => $all)
                            <option <?php if($all -> CategoryID == $id) echo "selected"; ?> value="{{$all -> CategoryID}}">{{$all -> ProductCategoryName}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <br>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-1 font-weight-bold text-primary">Danh sách Loại Đặc Trưng Sản Phẩm</h6>
                <a href="#" data-url="" class="btn btn-light btn-outline-primary btn-add" data-toggle="modal"   data-target="#modal-category-add">
                    <i class="fas fa-plus-circle fa-lg"></i>&nbsp;Thêm loại đặc trưng</a>
            </div>
            <div class="card-body LoadAllProductAttr" >
                @include('admin.pages.attribute-product.table-product-attr');
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();

            $(".nav-2").addClass("show");

            $('.nav-link-2').removeClass('collapsed');

            $('.btn-change-product').change(function(e) {
                var value = $('#dropdownProduct').val();
                console.log(value);
                var url = $(this).attr("url-data");
                console.log(url);
                $.ajax({
                    type: 'get',
                    url: url,
                    dataType: "html",
                    data:{
                        product_id:value,
                    },
                    success: function(data) {
                        $('.LoadAllProductAttr').html(data);
                        $('#dataTable').DataTable().draw();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {}
                })
            });
        });
    </script>
@endsection
