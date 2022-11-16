@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md float-left">

        <div class="form-inline">
            <select data-url="{{ URL::to('/list-order') }}" id="orderstatus" required class="form-control col-md-4">
                <option value="">--Chọn trạng thái đơn hàng--</option>
                @foreach ($orderStatus as $item)
                    <option value="{{ $item->OrderStatusID }}">{{ $item->OrderStatus }}</option>
                @endforeach
            </select>
        </div>

    </div>
    <div class=" float-right mr-2">
        <a class="export btn btn-success"><i class="fas fa-download"></i> Export Excel</a>
        <a class="btn btn-primary" data-toggle="modal" data-target="#importModal"><i class="fas fa-upload"></i> Import Excel</a>
    </div>
</div>
<hr />

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="float-left mt-2">
                <h5 class="m-0 font-weight-bold text-primary">Danh sách đơn hàng</h5>
            </div>
        </div>
        <div class="card-body list_order">
            @include('admin.orders.list_order')
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        // Lọc danh sách đơn hàng
        $('#orderstatus').on('change', function () {
            var OrderStatusID = $('#orderstatus').val();
            $('#dataTable').DataTable().clear();
            $('.table-responsive').remove();
            $.ajax({
                url: 'http://127.0.0.1:8000/list-order',
                data: { OrderStatusID: OrderStatusID },
                dataType: "html",
                type: 'GET',
                success: function (data) {
                    $('.list_order').html(data);
                    $('#dataTable').DataTable().draw();
                    $('[data-toggle="tooltip"]').tooltip();
                },
                error: function () {
                    alert("Đã có lỗi xảy ra");
                }
            });
        });
    });
</script>
@endsection



