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
			<div class="checkout-right LoadAllCart">
                @include('client.pages.table-checkout-test')
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

    <script>
       $(document).ready(function() {
			$('.value-minus').click(function () {
                var price = $(this).attr('price');
                var rowId = $(this).attr('data-id');
				var $input = $(this).parent().find('#input-amount');
				var count = parseInt($input.val()) - 1;
				count = count < 1 ? 1 : count;
				$input.val(count);
                var tt = price * count;
				$input.change();
                var url = "http://127.0.0.1:8000/change-amount-cart/" + rowId;
                $.ajax({
                    type: 'GET',
                    dataType: "json",
                    url: url,
                    data: {
                        count: count,
                    },
                    success: function(data) {
                        $('.change-price').html(
                            '<span class="change-price">' + new Intl.NumberFormat().format(tt) +  'VNĐ</span>'
                        );
                    },
                    error: function(jqXHR, textStatus, errorThrown, response) {
                    }
                })
            });
            $('.value-plus').click(function () {
                var subtotal =  $(this).attr('sub-price');

                var total =  $(this).attr('change-price-total');
                var rowId = $(this).attr('data-id');
                var price = $(this).attr('price');
                var $input = $(this).parent().find('#input-amount');
                var count = parseInt($input.val()) + 1;
                $input.val(count);
                $input.change();
                var url = "http://127.0.0.1:8000/change-amount-cart/" + rowId;
                var tt = price * count;
                var ttsub = parseInt(subtotal) + parseInt(price);
                console.log(subtotal);
                console.log(ttsub);
                $.ajax({
                    type: 'GET',
                    dataType: "json",
                    url: url,
                    data: {
                        count: count,
                    },
                    success: function(data) {

                        $('.change-price').html(
                            '<span class="change-price">' + new Intl.NumberFormat().format(tt) +  'VNĐ</span>'
                        );

                        // $('.change-price-sub').html(
                        //     '<span class="change-price-sub">' + new Intl.NumberFormat().format(ttsub) +  'VNĐ</span>'
                        // );

                        // $('.change-price-total').html(
                        //     '<span class="change-price-total">' + new Intl.NumberFormat().format(s) +  'VNĐ</span>'
                        // );
                    },
                    error: function(jqXHR, textStatus, errorThrown, response) {
                    }
                })
            });
		});
    </script>
	<!-- for bootstrap working -->
	<script src="{{ asset('client/js/bootstrap.js') }}"></script>
	<!-- //for bootstrap working -->
	<!-- //js-files -->

    <script>

    </script>
@endsection
