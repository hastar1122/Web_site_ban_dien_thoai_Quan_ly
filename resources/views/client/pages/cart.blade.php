<div class="agile_inner_drop_nav_info p-4">
    <?php
        $content = Cart::content();
    ?>
    <h5 class="mb-3">Sản phẩm mới thêm (<span style="color: #d60404">{{Cart::count()}}</span>)</h5>
    <div class="row">
        <div class="col-sm-8 multi-gd-img">
            <ul class="multi-column-dropdown">
                <table class="table-cart table-borderless table-striped">
                    @foreach ($content as $product_info)
                        <tr class="rem1">
                            <td class="invert-image1">
                                <a href="{{URL::to('/show-cart')}}">
                                    <img src="{{asset('imgProduct/'.$product_info->options->image)}}" alt=" " class="img-responsive">
                                </a>
                            </td>
                            <td class="invert">{{$product_info->name}}</td>
                            <td style="padding-left: 20px" class="invert"><span style="color: #d60404 !important">{{ number_format($product_info->price, 0, ',', '.') }} VNĐ<span></td>
                            </a>
                        </tr>
                    @endforeach
            </table>
            </ul>
        </div>
    </div>
    <a class="btn btn-danger btn-sm" href="{{URL::to('/delete-all-cart')}}">Xóa hết giỏi hàng</a>
</div>
