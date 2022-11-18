@extends('client.layouts.app')

@section('content')

	<!-- checkout page -->
	<div class="privacy py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				Lịch sử đặt hàng
			</h3>
			<!-- //tittle heading -->
			<div class="checkout-right LoadAllCart">
                @yield('history')
                {{-- @include('client.pages.table-cart-history') --}}
			</div>
		</div>
	</div>
	<!-- //checkout page -->


	<!-- for bootstrap working -->
	<script src="{{ asset('client/js/bootstrap.js') }}"></script>
	<!-- //for bootstrap working -->
	<!-- //js-files -->


@endsection
