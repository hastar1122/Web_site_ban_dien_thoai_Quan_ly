
@extends('client.pages.cart-history')

@section('history')

<a href="{{URL::to('/view-history/'.Auth::user()->UserID)}}" class="btn btn-primary mb-4"><i class="fas fa-undo"></i> Quay lại</a>
<div class="d-flex">

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
                    <?php if(Auth::check() && Auth::user()->RoleID==4) echo Auth::user()->UserName; ?>
                </dd>

                <dt class="col-md-4">
                    Địa chỉ:
                </dt>

                <dd class="col-md-8">
                    <?php if(Auth::check() && Auth::user()->RoleID==4) echo Auth::user()->Address; ?>
                </dd>

                <dt class="col-md-4">
                    Email:
                </dt>

                <dd class="col-md-8">
                    <?php if(Auth::check() && Auth::user()->RoleID==4) echo Auth::user()->Email; ?>
                </dd>

                <dt class="col-md-4">
                    Số điện thoại:
                </dt>

                <dd class="col-md-8">
                    <?php if(Auth::check() && Auth::user()->RoleID==4) echo Auth::user()->PhoneNumber; ?>
                </dd>

                <dt class="col-md-4">
                    Địa chỉ nhận hàng:
                </dt>

                <dd class="col-md-8">
                    {{$getOrder->Address}}
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
                <?php $i=0 ?>
                @foreach ($getOrderDetail as $orderdetail)
                <tbody>
                    <tr>
                        <td>{{$i += 1}}</td>
                        <td>{{ $orderdetail->ProductID }}</td>
                        <td>{{ $orderdetail->ProductName }}</td>
                        <td> <img height="40" src="{{asset('imgProduct/'.$orderdetail->Image)}}"> </td>
                        <td>{{ $orderdetail->Amount }}</td>
                        <td>{{ $orderdetail->Price }}</td>
                        <td>{{ $orderdetail->TotalPrice }}</td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
    <div class="card-footer">
        <div class="d-flex justify-content-between">
            <h5 class="text-primary">Tổng tiền: {{ number_format($getOrder->TotalPrice, 0, ',', '.') }} VND</h5>
        </div>

    </div>

</div>
@endsection
