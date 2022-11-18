@extends('client.layouts.app')

@section('content')
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <!-- Indicators-->
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item item1 active">
                <div class="container">
                    <div class="w3l-space-banner">
                        <div class="carousel-caption p-lg-5 p-sm-4 p-3">
                            <p>Get flat
                                <span>10%</span> Cashback
                            </p>
                            <h3 class="font-weight-bold pt-2 pb-lg-5 pb-4">The
                                <span>Big</span>
                                Sale
                            </h3>
                            <a class="button2" href="product.html">Shop Now </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item item2">
                <div class="container">
                    <div class="w3l-space-banner">
                        <div class="carousel-caption p-lg-5 p-sm-4 p-3">
                            <p>advanced
                                <span>Wireless</span> earbuds
                            </p>
                            <h3 class="font-weight-bold pt-2 pb-lg-5 pb-4">Best
                                <span>Headphone</span>
                            </h3>
                            <a class="button2" href="product.html">Shop Now </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item item3">
                <div class="container">
                    <div class="w3l-space-banner">
                        <div class="carousel-caption p-lg-5 p-sm-4 p-3">
                            <p>Get flat
                                <span>10%</span> Cashback
                            </p>
                            <h3 class="font-weight-bold pt-2 pb-lg-5 pb-4">New
                                <span>Standard</span>
                            </h3>
                            <a class="button2" href="product.html">Shop Now </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item item4">
                <div class="container">
                    <div class="w3l-space-banner">
                        <div class="carousel-caption p-lg-5 p-sm-4 p-3">
                            <p>Get Now
                                <span>40%</span> Discount
                            </p>
                            <h3 class="font-weight-bold pt-2 pb-lg-5 pb-4">Today
                                <span>Discount</span>
                            </h3>
                            <a class="button2" href="product.html">Shop Now </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!-- top Products -->
    <div class="ads-grid py-sm-5 py-4">
        <div class="container py-xl-4 py-lg-2">
            <!-- tittle heading -->
            <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
                <span>O</span>ur
                <span>N</span>ew
                <span>P</span>roducts
            </h3>
            <!-- //tittle heading -->
            <div class="row">
                <!-- product left -->
                <div class="agileinfo-ads-display col-lg-12">
                    <div class="wrapper">
                        <!-- first section -->
                        <div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
                            <h3 class="heading-tittle text-center font-italic">Sản Phẩm Mới</h3>
                            <div class="row" id="show-san-pham-moi">
                                @foreach ($newproduct as $product)
                                    <div class="col-md-4 product-men mt-5">
                                        <div class="men-pro-item simpleCart_shelfItem">
                                            <div class="men-thumb-item text-center">
                                                <img src="{{ asset('/imgProduct/' . $product->Image) }}" alt=""
                                                    style="width:200px;height:200px;object-fit:cover;">
                                                <div class="men-cart-pro">
                                                    <div class="inner-men-cart-pro">
                                                        <a href="{{ URL::to('/productdetail/'.$product->ProductID)  }}" class="link-product-add-cart">Xem Chi Tiết</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-info-product text-center border-top mt-4">
                                                <h4 class="pt-1">
                                                    <a
                                                        href="../productdetail/{{ $product->ProductID }}">{{ $product->ProductName }}</a>
                                                </h4>
                                                <div class="info-product-price my-2">
                                                    <span
                                                        class="item_price">{{ number_format($product->Price, 0, ',', '.') }}VNĐ</span>
                                                    <del>
                                                        {{ number_format($product->Price * 0.1 + $product->Price, 0, ',', '.') }}VNĐ</del>
                                                </div>
                                                <div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out"
                                                   >
                                                    <form data-url="{{ URL::to('/save-cart/' . $product->ProductID) }}">
                                                        {{ csrf_field() }}
                                                        <fieldset>
                                                            <input type="hidden" class="product_id" id=""
                                                                name="product_id" value="{{ $product->ProductID }}" />
                                                            <input type="hidden" name="amount" value="1" />
                                                            @if ($product->Amount === 0)
                                                            <input data-id="{{ $product->ProductID }}" type="button"  disabled
                                                           value="Cháy hàng rồi" class="button btn btn-add-cart" style="background-color:red;"/>
                                                       @elseif($product->Amount > 0)
                                                       <input data-id="{{ $product->ProductID }}" type="button"   
                                                           value="Thêm vào giỏ" class="button btn btn-add-cart" />
                                                       @endif
                                                        </fieldset>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <!-- //first section -->
                        <!-- second section -->
                        <div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
                            <h3 class="heading-tittle text-center font-italic">Điện Thoại Xịn</h3>
                            <div class="row">

                                @foreach ($iphoneproduct as $product)
                                    <div class="col-md-4 product-men mt-5">
                                        <div class="men-pro-item simpleCart_shelfItem">
                                            <div class="men-thumb-item text-center">
                                                <img src="{{ asset('/imgProduct/' . $product->Image) }}" alt=""
                                                    style="width:200px;height:200px;object-fit:cover;">
                                                <div class="men-cart-pro">
                                                    <div class="inner-men-cart-pro">
                                                        <a href="../productdetail/{{ $product->ProductID }}"
                                                            class="link-product-add-cart">Xem Chi
                                                            Tiết</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-info-product text-center border-top mt-4">
                                                <h4 class="pt-1">
                                                    <a
                                                        href="../productdetail/{{ $product->ProductID }}">{{ $product->ProductName }}</a>
                                                </h4>
                                                <div class="info-product-price my-2">
                                                    <span
                                                        class="item_price">{{ number_format($product->Price, 0, ',', '.') }}VNĐ</span>
                                                    <del>
                                                        {{ number_format($product->Price * 0.1 + $product->Price, 0, ',', '.') }}VNĐ</del>
                                                </div>
                                                <div
                                                    class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
                                                    <form data-url="{{ URL::to('/save-cart/' . $product->ProductID) }}">
                                                        {{ csrf_field() }}
                                                        <fieldset>
                                                            <input type="hidden" class="product_id" id=""
                                                                name="product_id" value="{{ $product->ProductID }}" />
                                                            <input type="hidden" name="amount" value="1" />
                                                            @if ($product->Amount === 0)
                                                                <input data-id="{{ $product->ProductID }}" type="button"
                                                                    isabled value="Cháy hàng rồi"
                                                                    class="button btn btn-add-cart"
                                                                    style="background-color:red;" />
                                                            @elseif($product->Amount > 0)
                                                                <input data-id="{{ $product->ProductID }}" type="button"
                                                                    value="Thêm vào giỏ"
                                                                    class="button btn btn-add-cart" />
                                                            @endif
                                                        </fieldset>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <!-- //second section -->
                        <!-- third section -->
                        <div class="product-sec1 product-sec2 px-sm-5 px-3">
                            <div class="row">
                                <h3 class="col-md-4 effect-bg">Summer Carnival</h3>
                                <p class="w3l-nut-middle">Get Extra 10% Off</p>
                                <div class="col-md-8 bg-right-nut">
                                    <img src="{{ asset('/client/images/image1.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                        <!-- //third section -->
                        <!-- fourth section -->
                        <div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mt-4">
                            <h3 class="heading-tittle text-center font-italic">Top Sản Phẩm Đắt Đỏ</h3>
                            <div class="row">
                                @foreach ($expenproduct as $product)
                                    <div class="col-md-4 product-men mt-5">
                                        <div class="men-pro-item simpleCart_shelfItem">
                                            <div class="men-thumb-item text-center">
                                                <img src="{{ asset('/imgProduct/' . $product->Image) }}" alt=""
                                                    style="width:200px;height:200px;object-fit:cover;">
                                                <div class="men-cart-pro">
                                                    <div class="inner-men-cart-pro">
                                                        <a href="../productdetail/{{ $product->ProductID }}"
                                                            class="link-product-add-cart">Xem Chi
                                                            Tiết</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-info-product text-center border-top mt-4">
                                                <h4 class="pt-1">
                                                    <a
                                                        href="../productdetail/{{ $product->ProductID }}">{{ $product->ProductName }}</a>
                                                </h4>
                                                <div class="info-product-price my-2">
                                                    <span
                                                        class="item_price">{{ number_format($product->Price, 0, ',', '.') }}VNĐ</span>
                                                    <del>
                                                        {{ number_format($product->Price * 0.1 + $product->Price, 0, ',', '.') }}VNĐ</del>
                                                </div>
                                                <div
                                                    class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
                                                    <form data-url="{{ URL::to('/save-cart/' . $product->ProductID) }}">
                                                        {{ csrf_field() }}
                                                        <fieldset>
                                                            <input type="hidden" class="product_id" id=""
                                                                name="product_id" value="{{ $product->ProductID }}" />
                                                            <input type="hidden" name="amount" value="1" />
                                                            @if ($product->Amount === 0)
                                                                <input data-id="{{ $product->ProductID }}" type="button"
                                                                    isabled value="Cháy hàng rồi"
                                                                    class="button btn btn-add-cart"
                                                                    style="background-color:red;" />
                                                            @elseif($product->Amount > 0)
                                                                <input data-id="{{ $product->ProductID }}" type="button"
                                                                    value="Thêm vào giỏ"
                                                                    class="button btn btn-add-cart" />
                                                            @endif
                                                        </fieldset>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- //fourth section -->
                    </div>
                </div>
                <!-- //product left -->
            </div>
            <!-- //product right -->
        </div>
    </div>
    <!-- //top products -->
    <script>
        $(document).ready(function() {
            $('.btn-add-cart').click(function(e) {
                var id = $(this).attr('data-id');
                console.log(id);
                var url = "http://127.0.0.1:8000/save-cart-view/" + id;
                console.log(url);
                $.ajax({
                    type: 'GET',
                    dataType: "json",
                    url: url,
                    success: function(data) {
                        toastr.success("Thêm giỏ hàng thành công!", "Thành công");
                        loadCart();
                    },
                    error: function(jqXHR, textStatus, errorThrown, response) {
                        toastr.error("Thêm giỏ hàng không thành công!", "Thất bại");
                    }
                })
            });

            function loadCart() {
                $('.dropdown-menu1').empty();
                $.ajax({
                    url: 'http://127.0.0.1:8000/view-cart',
                    dataType: "html",
                    type: 'GET',
                    success: function(data) {
                        $('.dropdown-menu1').html(data);
                    },
                    error: function() {
                        alert("Đã có lỗi xảy ra");
                    }
                });
            }
        });
    </script>
@endsection
