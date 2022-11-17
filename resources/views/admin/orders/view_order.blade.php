@extends('admin.layouts.app')

@section('content')
<a href="{{URL::to('/manager-order') }}" class="btn btn-primary mb-4"><i class="fas fa-undo"></i> Quay lại</a>
<div class="d-flex">
    <div class="card shadow border-left-info col-md mr-3 mb-4">
        <div class="card-header">
            <h4 class="text-info m-0">Thông tin hóa đơn</h4>
        </div>
    
        <div class="card-body pb-0 info_order">
            @include('admin.orders.info_order')
        </div>
    </div>
    
    <div class="card shadow border-left-info col-md mb-4">
        <div class="card-header">
            <h4 class="text-info m-0">Thông tin khách hàng</h4>
        </div>
    
        <div class="card-body pb-0">
            <dl class="row dl-horizontal mb-0">
                <dt class="col-md-4">
                    Tên khách hàng:
                </dt>
    
                <dd class="col-md-8">
                    {{ $customer->UserName }}
                </dd>
    
                <dt class="col-md-4">
                    Địa chỉ:
                </dt>
    
                <dd class="col-md-8">
                    {{ $customer->Address }}
                </dd>
    
                <dt class="col-md-4">
                    Email:
                </dt>
    
                <dd class="col-md-8">
                    {{ $customer->Email }}
                </dd>
    
                <dt class="col-md-4">
                    Số điện thoại:
                </dt>
    
                <dd class="col-md-8">
                    {{ $customer->PhoneNumber }}
                </dd>
    
                <dt class="col-md-4">
                    Địa chỉ nhận hàng:
                </dt>
    
                <dd class="col-md-8">
                    {{ $order->Address }} 
                </dd>
            </dl>
        </div>
    </div>
</div>

<div class="card shadow mb-4 border-left-info">
    <div class="card-header py-3">
        <div class="float-left mt-2">
            <h5 class="m-0 text-primary">Danh sách sản phẩm</h5>
        </div>
        <div class="float-right mb-n3 row">
            <div>
                <a class="export btn btn-success"><i class="fas fa-download"></i> In hóa đơn</a>
            </div>
        </div>
    </div>
    <div class="card-body LoadAllSinhVien">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width: 1%;">STT</th>
                        <th>Mã sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>

                <tbody>
                    @php
                    $i = 0;
                    @endphp
                    @foreach($products as $product)
                    @php
                    $i++;   
                    @endphp
                    <tr>
                        <td><i>{{ $i }}</i></td>
                        <td>{{ $product->ProductCode}}</td>
                        <td>{{ $product->ProductName }}</td>
                        <td>
                            @if ($product->Image)
                                <img width="90" height="90" src="http://127.0.0.1:8000/imgProduct/{{$product->Image}}">
                            @endif 
                        </td>
                        <td>{{ $product->Amount}}</td>
                        <td>{{ number_format($product->Price, 0, ',', '.') }}</td>
                        <td>
                            {{ number_format($product->TotalPrice, 0, ',', '.') }}        
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <div class="d-flex justify-content-between"> 
            <h5 class="text-primary">Tổng tiền: {{ number_format($order->TotalPrice, 0, ',', '.') }} VND</h5> 
            <form class="form-inline">
                <label class="control-label mr-sm-2 text-info">Cập nhật trạng thái đơn hàng: </label>
                <select name="OrderStatusID" data-id="{{ $order->OrderID }}" id="OrderStatusID" class="form-control">
                    @foreach ($orderStatus as $item)
                        <option value="{{ $item->OrderStatusID }}"  @selected($item->OrderStatusID == $order->OrderStatusID)>{{ $item->OrderStatus }}</option>
                    @endforeach
                </select>
            </form>
        </div>
        
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#OrderStatusID').change(function (e) { 
            e.preventDefault();
            var OrderStatusID = $("#OrderStatusID").val();
            var formData = new FormData;
            formData.append("OrderStatusID", OrderStatusID);
            $.ajax({
                async: true,
                url: 'http://127.0.0.1:8000/update-order/' + $('#OrderStatusID').attr('data-id'),
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                type: 'POST',
                success: function (data) {
                    if (data == true) {
                        $('.info_order').empty();
                        $.ajax({
                            url: 'http://127.0.0.1:8000/info-order/' + $('#OrderStatusID').attr('data-id'),
                            dataType: "html",
                            type: 'GET',
                            success: function (data) {
                                $('.info_order').html(data);
                            },
                            error: function () {
                                alert("Đã có lỗi xảy ra");
                            }
                        });
                        toastr.options.positionClass = "toast-bottom-right";
                        toastr.success("Cập nhật đơn hàng thành công");
                    }
                    else {
                        alert(`Sản phẩm ${data.ProductName} có mã là ${data.ProductCode} chỉ còn ${data.Amount} sản phẩm`);
                        toastr.options.positionClass = "toast-bottom-right";
                        toastr.warning('Cập nhật đơn hàng không thành công');
                    }
                },
                error: function () {
                    toastr.options.positionClass = "toast-bottom-right";
                    toastr.warning('Có lỗi xảy ra');
                }
            });
        });
    }); 
</script>
@endsection