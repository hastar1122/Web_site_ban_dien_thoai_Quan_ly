@extends('client.layouts.app')

@section('content')

	<!-- checkout page -->
	<div class="privacy py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				Giỏ hàng của bạn
			</h3>
			<!-- //tittle heading -->
			<div class="checkout-right">
				<div class="table-responsive">
					<table class="timetable_sub">
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
                            echo '<pre>';
                            print_r($content);
                            echo '</pre>';
                        ?>
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
											<div class="entry value-minus">&nbsp;</div>
											<div class="entry value">
												<span>{{$product_info->qty}}</span>
											</div>
											<div class="entry value-plus active">&nbsp;</div>
										</div>
									</div>
								</td>
								<td class="invert">{{$product_info->name}}</td>
								<td class="invert">{{ number_format($product_info->price, 0, ',', '.') }} VNĐ</td>
                                <td class="invert"><?php
                                    $tt = $product_info->price * $product_info->qty;
                                    echo number_format($tt, 0, ',', '.');
                                ?> VNĐ</td>
								<td class="invert">
									<div class="rem">
                                        <a class="close1" href="{{URL::to('/delete-cart/'.$product_info->rowId)}}"></a>
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
                                    <td class="invert">{{ Cart::priceTotal(0) }} VNĐ</td>
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
                                    <td class="invert">{{ Cart::total(0) }} VNĐ</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
				</div>
			</div>
			<div class="checkout-left">
				<div class="address_form_agile mt-sm-5 mt-4">
					<h4 class="mb-sm-4 mb-3">Add a new Details</h4>
					<form action="payment.html" method="post" class="creditly-card-form agileinfo_form">
						<div class="creditly-wrapper wthree, w3_agileits_wrapper">
							<div class="information-wrapper">
								<div class="first-row">
									<div class="controls form-group">
										<input class="billing-address-name form-control" type="text" name="name" placeholder="Full Name" required="">
									</div>
									<div class="w3_agileits_card_number_grids">
										<div class="w3_agileits_card_number_grid_left form-group">
											<div class="controls">
												<input type="text" class="form-control" placeholder="Mobile Number" name="number" required="">
											</div>
										</div>
										<div class="w3_agileits_card_number_grid_right form-group">
											<div class="controls">
												<input type="text" class="form-control" placeholder="Landmark" name="landmark" required="">
											</div>
										</div>
									</div>
									<div class="controls form-group">
										<input type="text" class="form-control" placeholder="Town/City" name="city" required="">
									</div>
									<div class="controls form-group">
										<select class="option-w3ls">
											<option>Select Address type</option>
											<option>Office</option>
											<option>Home</option>
											<option>Commercial</option>

										</select>
									</div>
								</div>
								<button class="submit check_out btn">Delivery to this Address</button>
							</div>
						</div>
					</form>
					<div class="checkout-right-basket">
						<a href="payment.html">Make a Payment
							<span class="far fa-hand-point-right"></span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- //checkout page -->

	<!-- middle section -->
	<div class="join-w3l1 py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<div class="row">
				<div class="col-lg-6">
					<div class="join-agile text-left p-4">
						<div class="row">
							<div class="col-sm-7 offer-name">
								<h6>Smooth, Rich & Loud Audio</h6>
								<h4 class="mt-2 mb-3">Branded Headphones</h4>
								<p>Sale up to 25% off all in store</p>
							</div>
							<div class="col-sm-5 offerimg-w3l">
								<img src="images/off1.png" alt="" class="img-fluid">
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 mt-lg-0 mt-5">
					<div class="join-agile text-left p-4">
						<div class="row ">
							<div class="col-sm-7 offer-name">
								<h6>A Bigger Phone</h6>
								<h4 class="mt-2 mb-3">Smart Phones 5</h4>
								<p>Free shipping order over $100</p>
							</div>
							<div class="col-sm-5 offerimg-w3l">
								<img src="images/off2.png" alt="" class="img-fluid">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- middle section -->

	<!-- for bootstrap working -->
	<script src="{{ asset('client/js/bootstrap.js') }}"></script>
    <script src="{{ asset('client/js/minicart.js') }}"></script>
	<!-- //for bootstrap working -->
	<!-- //js-files -->

    <script>

    </script>
@endsection
