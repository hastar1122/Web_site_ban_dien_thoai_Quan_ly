@extends('client.pages.cart-history')

@section('history')
    @if (!empty($message))
        <script>
            function showError() {
                toastr.error("Đã hủy đơn hàng");
            }
            window.showError();
        </script>
    @endif
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
                    <form action="{{URL::to('/delete-order/'.$order->OrderID)}}" method="GET">
                    <div class="rem">
                        <input hidden name="customerid" value="<?php echo Auth::user()->UserID ?>">
                        <a class="information btn btn-sm btn-primary" href="{{URL::to('/view-history-detail/'.$order->OrderID)}}" title="Xem chi tiết"><i class="fas fa-eye"></i></a>
                        @if ($order->OrderStatusID == 1)
                            <button type="submit" onclick="return confirm('Bạn có chắc là muốn xóa đơn hàng này không?')" class="information btn btn-sm btn-danger"  title="Xóa đơn hàng"><i class="fas fa-trash"></i></button>
                        @endif
                    </div>
                    </form>
                </td>
            </tr>
        </tbody>
        @endforeach
    </table>
    <br>
</div>


@endsection
