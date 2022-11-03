@extends('layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800" style="color: #0099FF;">Quản lí đơn hàng</h1>
   
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã đơn hàng</th>
                            <th>Ngày</th>
                            <th>Trạng thái</th>
                            <th>Tổng tiền</th>
                            <th>Tác vụ</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                        $i = 0;
                        @endphp
                        @foreach($order as $key => $ord)
                        @php
                        $i++;   
                        @endphp
                        <tr>
                            <td><i>{{ $i }}</i></td>
                            <td>{{ $ord -> OrderCode}}</td>
                            <td>{{ $ord -> OrderDate}}</td>
                            <td>
                                @if($ord -> OrderStatus==1)
                                    Đơn hàng mới
                                @else
                                    Đang xử lí
                                @endif                         
                            </td>
                            <td>{{ $ord -> TotalPrice }}</td>
                            <td>
                                <a class="information btn btn-sm btn-primary" href="{{ URL::to('/view-order/'.$ord->OrderID)}}" title="Xem chi tiết"><i class="far fa-edit"></i></a>
                                <a class="information btn btn-sm btn-danger" href="" title="Xem chi tiết"><i class="fas fa-trash"></i></a>
                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<!-- /.container-fluid -->
@endsection




