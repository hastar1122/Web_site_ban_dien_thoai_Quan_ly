@extends('client.layouts.app')

@section('content')

	<!-- banner-2 -->
	<div class="page-head_agile_info_w3l">

	</div>
	<!-- //banner-2 -->
	<!-- page -->
	<div class="services-breadcrumb">
		<div class="agile_inner_breadcrumb">
			<div class="container">
				<ul class="w3_short">
					<li>
						<a href="/showClient">Home</a>
						<i>|</i>
					</li>
					<li>
                        Chi tiết sản phẩm
                        <i>|</i>
                    </li>
                    <li>
                        {{ $product->ProductName }}
                    </li>
				</ul>
			</div>
		</div>
	</div>
	<!-- //page -->

	<!-- Single Page -->
	<div class="banner-bootom-w3-agileits py-5">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				<span>T</span>hông
				<span>T</span>in
                <span>S</span>ản
                <span>P</span>hẩm
            </h3>
			<!-- //tittle heading -->
			<div class="row mb-4">
				<div class="col-lg-5 col-md-8 single-right-left ">
					<div class="grid images_3_of_2">
						<div class="flexslider">
							<div class="thumb-image">
                                <img src="{{ asset('/imgProduct/' . $product->Image) }}" data-imagezoom="true" class="img-fluid" alt="">
                            </div>
							<div class="clearfix"></div>
						</div>
					</div>

					<p class="my-sm-4 my-3 text-primary">
						<i class="fas fa-info-circle"></i> Thông tin chi tiết
					</p>
					<table class="table table-striped table-sm">
						<tbody>
							@php
								$y = 0;
							@endphp
							@for ($i = 0; $i < count($attributes); $i++)
								<tr>
									<td style="border: none">{{ $attributes[$i]->AttributeName }}</td>
									@if ($y < count($attributevalues))
										<td style="border: none">{{ $attributevalues[$i]->Value }}</td>
                                        @php
                                            $y++;
                                        @endphp
									@else
										<td style="border: none"></td>
                                    @endif 
									
								</tr>
							@endfor
						</tbody>
					</table>
				</div>

				<div class="col-lg-7 single-right-left simpleCart_shelfItem">
					<div class="d-flex justify-content-between">
						<h3 class="mb-3">{{ $product->ProductName }}</h3>
						<div>
							@if ($product->Amount > 0)
							<p class="text-right text-success"><i class="fas fa-check-square"></i> Còn hàng</p>
							@else
								<p class="text-right text-danger"><i class="fas fa-exclamation-circle"></i> Hết hàng</p>
							@endif
						</div>
					</div>
					<p class="mb-3">
						<span class="item_price">{{ number_format($product->Price, 0, ',', '.') }}VNĐ</span>
						<del class="mx-2 font-weight-light">{{ number_format($product->Price * 0.1 + $product->Price, 0, ',', '.') }}VNĐ</del>
						<label class="text-primary">Free ship</label>
					</p>
					<div class="single-infoagile">
						<ul>
							<li class="mb-3">
								Thanh toán khi nhận hàng.
							</li>
							<li class="mb-3">
								Ship hàng toàn quốc.
							</li>
							<li class="mb-3">
								Cam kết sản phẩm chất lượng tốt nhất
							</li>
							<li class="mb-3">
								Khuyến mãi 10%
							</li>
						</ul>
					</div>
					<div class="product-single-w3l">
						<p class="my-3">
							<i class="far fa-hand-point-right mr-2"></i>
							<label>1 Năm </label>
							 Bảo hành
						</p>
					</div>
					<div class="quantity">
						<div class="quantity-select">
							Chọn số lượng
							<div class="entry value-minus">&nbsp;</div>
							<div class="entry value">
								<span class="quality">1</span>
							</div>
							<div class="entry value-plus active">&nbsp;</div>
						</div>
					</div>
					<div class="occasion-cart mt-3">
						<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
							<form action="#" method="post">
								<fieldset>
									<input type="hidden" name="cmd" value="_cart" />
									<input type="hidden" name="add" value="1" />
									<input type="hidden" name="business" value=" " />
									<input type="hidden" name="item_name" value="Samsung Galaxy J7 Prime" />
									<input type="hidden" name="amount" value="200.00" />
									<input type="hidden" name="discount_amount" value="1.00" />
									<input type="hidden" name="currency_code" value="USD" />
									<input type="hidden" name="return" value=" " />
									<input type="hidden" name="cancel_return" value=" " />
									<input data-id="{{ $product->ProductID }}" data-amount="{{ $product->Amount }}" type="submit" name="submit" value="Mua ngay" class="button btn-buy" />
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>

            <hr>
            {{-- Thông tin mô tả --}}
            <div class="row mt-3">
                    {!! $product->ProductDescription !!}
            </div>
		</div>
	</div>
	<!-- //Single Page -->
@endsection

@section('scripts')
<script>
	$(document).ready(function () {
		$('.btn-buy').click(function (e) {
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			e.preventDefault();
			var productID = $(this).attr('data-id');
			var amount = $(this).attr('data-amount');
			var quality = $('.quality').html();
			if (!amount) {
				alert('Sản phẩm đã hết hàng vui lòng chọn sản phẩm khác');
				toastr.error("Thêm giỏ không hàng thành công!","Thất bại");
				return;
			}
			var formData = new FormData;
            formData.append("ProductID", productID);
			formData.append("Quality", quality);
            $.ajax({
                async: true,
                url: 'http://127.0.0.1:8000/buy-product',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                type: 'POST',
                success: function (data) {
                    if (data == true) {
                        loadCart();
                        toastr.options.positionClass = "toast-bottom-right";
                        toastr.success("Thêm giỏ hàng thành công!","Thành công");
                        var quality = $('.quality').html(1);
                    }
                    else {
                        toastr.options.positionClass = "toast-bottom-right";
                        toastr.error("Thêm giỏ hàng không thành công!","Thất bại");
                    }
                },
                error: function () {
                    toastr.options.positionClass = "toast-bottom-right";
                    toastr.error("Thêm giỏ hàng không thành công!","Thất bại");
                }
            });
		});

		$('.value-minus').click(function () {
			var quality = $('.quality').html();
			quality = parseInt(quality) - 1;
			quality = quality < 1 ? 1 : quality;
			$('.quality').html(quality);
		});

		$('.value-plus').click(function () {
			var quality = $('.quality').html();
			quality = parseInt(quality) + 1;
			$('.quality').html(quality);
		});

		function loadCart() {
			$('.dropdown-menu1').empty();
            $.ajax({
                url: 'http://127.0.0.1:8000/view-cart',
                dataType: "html",
                type: 'GET',
                success: function (data) {
                    $('.dropdown-menu1').html(data);
                },
                error: function () {
                    alert("Đã có lỗi xảy ra");
                }
            });
		}
	});
</script>
@endsection
