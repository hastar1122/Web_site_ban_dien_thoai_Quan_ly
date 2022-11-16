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
					<h4 class="mb-sm-4 mb-3">Thêm địa chỉ giao hàng</h4>
					<div class="creditly-card-form agileinfo_form">
						<div class="creditly-wrapper wthree, w3_agileits_wrapper">
							<div class="information-wrapper">
                                {{ csrf_field() }}
								<div class="first-row">
									<div class="controls form-group">
										<input class="billing-address-name form-control" type="text" name="order-address" placeholder="Nhập địa chỉ giao hàng">
									</div>
								</div>
                                <input id="check-out" hidden value="<?php
                                    if (Auth::check() && Auth::user()->RoleID==4) {
                                        echo 1;
                                    } else {
                                        echo 0;
                                    }
                                ?>">
								<button class="check_out btn btn-checkout">Đặt hàng</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- //checkout page -->


    {{-- check nhập đủ thông tin  --}}
    <input id="check-out-info" hidden value="<?php
        if (Auth::check() && Auth::user()->RoleID==4) {
            if (Auth::user()->Address && Auth::user()->Email && Auth::user()->PhoneNumber) {
                echo 1;
            }
            else {
                echo 0;
            }

        } else {
            echo 0;
        }
    ?>">

    {{-- check nhập đủ thông tin  --}}
    <input id="customer-id" hidden value="<?php
        if (Auth::check() && Auth::user()->RoleID==4) {
            echo Auth::user()->UserID;
        }
    ?>">

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
	<!-- //for bootstrap working -->
	<!-- //js-files -->

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.btn-checkout').click(function () {
                //kiểm tra đăng nhập chưa
                var check = $('#check-out').val();
                if (check == 0) {
                    $("#exampleModal").modal('show');
                    toastr.error("Bạn chưa đăng nhập", "Đặt hàng thất bại");
                    return;
                }

                //kiểm tra đã cập nhật thông tin chưa
                var checkinfo = $('#check-out-info').val();
                if (checkinfo == 0) {
                    $("#infUserModal").modal('show');
                    toastr.error("Bạn chưa cập nhật thông tin", "Đặt hàng thất bại");
                    return;
                }

                //lấy mã nhân viên
                var customerid = $('#customer-id').val();
                console.log(customerid);
                var url = "{{route('order-product.store')}}";
                console.log(url);

                $.ajax({
                    type: 'POST',
                    dataType: "json",
                    url: url,
                    data: {
                        customerid: customerid,
                    },
                    success: function(data) {
                        toastr.success("Đặt hàng thành công", "Thành công");
                    },
                    error: function(jqXHR, textStatus, errorThrown, response, data) {
                        console.log(data);
                        toastr.error("Đặt hàng thất bại", "Thất bại");
                    }
                })
            });

            });
    </script>
@endsection
