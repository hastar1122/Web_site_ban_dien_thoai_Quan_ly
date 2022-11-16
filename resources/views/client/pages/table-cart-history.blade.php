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
        @if($content)
        @foreach ($content as $product_info)
        <tbody>
            <tr class="rem1">
                <td class="invert">1</td>
                <td class="invert-image">
                    <a href="single.html">
                        <img height="50" src="{{asset('imgProduct/'.$product_info->options->image)}}" alt=" " class="img-responsive">
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
                        <a class="btn btn-danger btn-delete" href="{{URL::to('/delete-cart/'.$product_info->rowId)}}"><i class="fas fa-trash"></i></a>
                    </div>
                </td>
            </tr>
        </tbody>
        @endforeach
        @endif
    </table>
    <br>
</div>
