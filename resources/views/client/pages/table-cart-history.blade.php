@extends('client.pages.cart-history')

@section('history')
<div class="table-responsive">
    <table class="table table-bordered" id="dataTable">
        <thead>
            <tr>
                <th>STT</th>
                <th>Ngày đặt</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        @foreach ($content as $order)
        <tbody>
            <tr class="rem1">
                <td class="invert">1</td>
                <td class="invert">{{$order->OrderDate}}</td>
                <td class="invert">{{ number_format($order->TotalPrice, 0, ',', '.') }} VNĐ</td>
                <td class="invert">
                @if ($order->OrderStatusID == 1)
                    <span class="badge badge-primary">Đang xử lý</span>
                @endif
                @if ($order->OrderStatusID == 2)
                    <span class="badge badge-info">Đang giao hàng</span>
                @endif
                @if ($order->OrderStatusID == 3)
                    <span class="badge badge-success">Giao hàng thành công</span>
                @endif
                @if ($order->OrderStatusID == 4)
                    <span class="badge badge-danger">Đã hủy</span>
                @endif
                </td>
                <td class="invert">
                    <div class="rem">
                        <?php if($order->OrderStatusID == 1)  echo '<a class="btn btn-danger btn-sm btn-delete" href=""><i class="fas fa-trash"></i></a>';?>
                        <a class="information btn btn-sm btn-primary" href="{{URL::to('/view-history-detail/'.$order->OrderID)}}" title="Xem chi tiết"><i class="fas fa-eye"></i></a>
                    </div>
                </td>
            </tr>
        </tbody>
        @endforeach
    </table>
    <br>
</div>
@endsection
