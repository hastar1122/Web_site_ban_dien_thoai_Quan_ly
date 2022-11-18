<div class="table-responsive">
    <table class="table table-bordered" id="dataTable">
        <thead>
            <tr>
                <th>STT</th>
                <th>Hình ảnh</th>
                <th>Sổ lượng</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Tổng tiền</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <?php
            $content = Cart::content();
            // echo '<pre>';
            // print_r($content);
            // echo '</pre>';
        ?>
        @if($content)
        @foreach ($content as $product_info)
        <tbody>
            <tr class="rem1">
                <td class="invert">1</td>
                <td class="invert-image">
                    <a href="../productdetail/{{ $product_info->id }}">
                        <img height="40"  src="{{asset('imgProduct/'.$product_info->options->image)}}" alt=" " class="img-responsive">
                    </a>
                </td>
                <td class="invert">
                    <div class="quantity">
                        <div class="quantity-select">
                            <div data-id="{{$product_info->rowId}}" price="{{$product_info->price}}" class="entry value-minus">&nbsp;</div>
                            <div class="entry value">
                                <input data-id="{{$product_info->rowId}}" id="input-amount" style="margin-top: -10px" class="entry value" value="{{$product_info->qty}}">
                            </div>
                            <div data-id="{{$product_info->rowId}}" price="{{$product_info->price}}" sub-price="{{ Cart::priceTotal(0,'','') }}" class="entry value-plus active">&nbsp;</div>
                        </div>
                    </div>
                </td>
                <td class="invert">{{$product_info->name}}</td>
                <td class="invert">{{ number_format($product_info->price, 0, ',', '.') }} VNĐ</td>
                <td class="invert">
                    <span class="change-price"><?php
                        $tt = $product_info->price * $product_info->qty;
                        echo number_format($tt, 0, ',', '.');
                        ?> VNĐ</span>
                </td>
                <td class="invert">
                    <div class="rem">
                        <a class="btn btn-danger btn-sm btn-delete" href="{{URL::to('/delete-cart/'.$product_info->rowId)}}"><i class="fas fa-trash"></i></a>
                    </div>
                </td>
            </tr>
        </tbody>
        @endforeach
        @endif
    </table>
    <br>
    <div class="table-responsive">
        <table class="timetable_sub1 timetable_sub">
            <tbody>
                <tr class="rem1">
                    <th>Tổng tiền</th>
                    <td class="invert">
                        <span class="change-price-sub">{{ Cart::priceTotal(0) }} VNĐ</span>
                    </td>
                </tr>
                <tr class="rem1">
                    <th>Giảm giá</th>
                    <td class="invert">{{ Cart::discount() }} VNĐ</td>
                </tr>
                <tr class="rem1">
                    <th>Phí ship</th>
                    <td class="invert">Free</td>
                </tr>

                <tr class="rem1">
                    <th>Thanh toán</th>
                    <td class="invert">
                        <span class="change-price-total">{{ Cart::total(0) }} VNĐ</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {

        $('.value-minus').click(function () {
            var rowId = $(this).attr('data-id');
            var $input = $(this).parent().find('#input-amount');
            var count = parseInt($input.val()) - 1;
            count = count < 1 ? 1 : count;
            $input.val(count);
            $input.change();
            var url = "http://127.0.0.1:8000/change-amount-cart/" + rowId;
            $.ajax({
                type: 'GET',
                dataType: "html",
                url: url,
                data: {
                    count: count,
                },
                success: function(data) {
                    $('.LoadAllCart').html(data);
                    $('#dataTable').DataTable().draw();
                },
                error: function(jqXHR, textStatus, errorThrown, response) {
                }
            })
        });
        $('.value-plus').click(function () {
            var rowId = $(this).attr('data-id');
            var $input = $(this).parent().find('#input-amount');
            var count = parseInt($input.val()) + 1;
            $input.val(count);
            $input.change();
            var url = "http://127.0.0.1:8000/change-amount-cart/" + rowId;
            console.log(url);
            $.ajax({
                type: 'GET',
                dataType: "html",
                url: url,
                data: {
                    count: count,
                },
                success: function(data) {
                    $('.LoadAllCart').html(data);
                    $('#dataTable').DataTable().draw();
                },
                error: function(jqXHR, textStatus, errorThrown, response) {
                }
            })
        });

    });
 </script>
