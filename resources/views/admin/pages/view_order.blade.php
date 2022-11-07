@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow border-left-info mb-4">
        <div class="card-header">
            <h4 class="text-info m-0">Thông tin khách hàng</h4>
        </div>

        <div class="card-body pb-0">
            <dl class="row dl-horizontal mb-0">
                <dt class="col-md-3">
                    Tên khách hàng: 
                </dt>

                <dd class="col-md-9">
                    {{$customer -> UserName}}
                </dd>

                <dt class="col-md-3">
                    Số điện thoại: 
                </dt>

                <dd class="col-md-9">
                    {{$customer -> PhoneNumber}}
                </dd>

                <dt class="col-md-3">
                    Địa chỉ nhận hàng: 
                </dt>

                <dd class="col-md-9">
                    {{$customer -> Address}}
                </dd>

                <dt class="col-md-3">
                    Email:
                </dt>

                <dd class="col-md-9">
                    {{$customer -> Email}}
                </dd>
                <dt class="col-md-3">
                    Tên nhân viên giao hàng:
                </dt>

                <dd class="col-md-9">
                    {{$employee -> UserName}}
                </dd>
            </dl>
        </div>
    </div>
    <div class="card shadow mb-4 border-left-info">
        <div class="card-header py-3">
            <div class="float-left mt-2">
                <h5 class="m-0 text-primary">Danh sách đơn hàng</h5>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> 
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Ảnh</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach($order_detail as $key => $detail)
                        @php
                            $i++;   
                        @endphp
                         <tr>
                            <td><i>{{ $i }}</i></td>
                            <td>{{ $product -> ProductName}}</td>
                            <td>{{ $product -> Image}}</td>
                            <td>{{ $detail -> Amount}}</td>
                            <td>{{ $product -> Price}}</td>
                            <td>{{ $detail -> Amount*$product -> Price}}</td>
                         </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">

        </div>
    </div>
    <div class="card-body">
            <div class="panel-heading>">
                <h3 class="panel-title" style="color: #0099FF ;"></h3>
            </div>
            <div class="panel-body">
                
            </div>
        </div>
</div>
@endsection