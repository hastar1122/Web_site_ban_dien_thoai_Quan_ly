@extends('admin.layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Đặc Trưng Sản Phẩm</h1>
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

        {{-- <button type="button" class="btn-them-dac-trung btn btn-outline-success"><i class="far fa-edit"></i>
            Thêm</button> --}}
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-1 font-weight-bold text-primary">Danh sách Loại Sản Phẩm</h6>
                <form >
                    <select class="btn btn-light btn-outline-primary btn-add btn-change-product" id="dropdownProduct" url-data="{{ URL::to('/show-attribute-product-all/1') }}">
                        @foreach ($all_category as $key => $all)
                            <option <?php if($all -> CategoryID == $id) echo "selected"; ?> value="{{$all -> CategoryID}}">{{$all -> ProductCategoryName}}</option>
                        @endforeach
                    </select>
                    <input type="submit" hidden>
                </form>
                <a href="#" data-url="" class="btn btn-light btn-outline-primary btn-add" data-toggle="modal"   data-target="#modal-category-add">
                    <i class="fas fa-plus-circle fa-lg"></i>&nbsp;Thêm loại đặc trưng</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Mã đặc trưng</th>
                                <th>Tên đặc trưng</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_attr_product as $product_attr)
                            <tr>
                                <td>{{ $product_attr -> AttributeID }}</td>
                                <td>{{ $product_attr -> AttributeName }}</td>
                                <td>
                                    <a delete-attr-url="{{ URL::to('/delete-attribute-product/'. $product_attr -> AttributeID)}}" type="button"
                                        class="btn-delete-attr btn btn-danger btn-delete"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    @include('admin.pages.attribute-product.add')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.btn-change-product').change(function(e) {
                var value = $('#dropdownProduct').val();
                console.log(value);
                var url = $(this).attr("url-data");
                console.log(url);
                $.ajax({
                    type: 'get',
                    url: url,
                    success: function(response) {
                        window.location.href = "{{ URL::to('/show-attribute-product-all/') }}" +'/'+ value;
                    },
                    error: function(jqXHR, textStatus, errorThrown) {}
                })
            });
            $('.btn-them-dac-trung').click(function(e) {
                var value = $('#dropdownProduct').val();
                url = "{{ URL::to('/add-attribute-product/')}}" +'/'+ value;
                console.log(url);
                console.log( $("#dropdownProductAttribute").val());
                $.ajax({
                    type: 'post',
                    url: url,
                    data: {
                        attr_id: $("#dropdownProductAttribute").val(),
                    },
                    success: function(response) {
                        toastr.success('Thêm thành công', "Thành công");
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        toastr.error('Thêm thất bại', "Thất bại");
                    }
                })
            });
            $(".btn-delete-attr").click(function() {
                var value = $('#dropdownProduct').val();
                var url = $(this).attr("delete-attr-url");
                console.log(url);
                console.log( $("#dropdownProduct").val());
                if (confirm("Bạn có chắc muốn xóa không?")) {
                    $.ajax({
                        type: "get",
                        dataType: "json",
                        url: url,
                        data: {
                            value: value,
                        },
                        success: function() {
                            toastr.success("Xóa đặc trưng thành công!");
                            location.reload();
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            toastr.error(
                                "Xóa thương hiệu này thất bại!");
                        },
                    });
                }
            });
        });
    </script>
@endsection
