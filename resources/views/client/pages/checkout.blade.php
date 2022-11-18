@extends('client.layouts.app')

@section('content')
	<!-- checkout page -->
	<div class="privacy py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				Giỏ hàng của bạn
			</h3>
            @if (session('message'))
            <div class="alert alert-success">
                <strong>Thành công!</strong> Đặt hàng thành công.
            </div>
            @endif
			<!-- //tittle heading -->
			<div class="checkout-right LoadAllCart">
                @include('client.pages.table-checkout-test')
			</div>
			<div class="checkout-left">
				<div class="address_form_agile mt-sm-5 mt-4">
					<h4 class="mb-sm-4 mb-3">Thêm địa chỉ giao hàng</h4>
					<div class="creditly-card-form agileinfo_form">
						<div class="creditly-wrapper wthree, w3_agileits_wrapper">
							<form class="information-wrapper" action="{{URL::to('/order-product')}}" method="POST">
                                {{ csrf_field() }}
								<div class="first-row">
									<div class="controls form-group">
										<input class="billing-address-name form-control" type="text" name="orderaddress" placeholder="Nhập địa chỉ giao hàng" required>
									</div>
								</div>
                                <input name="customer_id" id="customer_id" hidden value="<?php
                                    if (Auth::check() && Auth::user()->RoleID==4) {
                                        echo Auth::user()->UserID;
                                    }
                                ?>">
                                <input id="check-out" hidden value="<?php
                                    if (Auth::check() && Auth::user()->RoleID==4) {
                                        echo 1;
                                    } else {
                                        echo 0;
                                    }
                                ?>">

                                <?php
                                    if (Auth::check() && Auth::user()->RoleID==4 && Auth::user()->Address && Auth::user()->Email && Auth::user()->PhoneNumber) {
                                        echo '<button type="submit" class="submit check_out btn">Đặt hàng</button>';
                                    } else {
                                        echo '<button type="button" class="submit check_out btn btn-checkout">Đặt hàng</button>';
                                    }
                                ?>
                                </form>
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
            $('.btn-checkout').click(function (e) {
				e.preventDefault();

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
            });

            });
    </script>
@endsection
