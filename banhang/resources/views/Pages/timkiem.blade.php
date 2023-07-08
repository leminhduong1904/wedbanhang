@extends("layouts.master")
@section("content")
<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="beta-products-list">
							<h4>Sản  Phẩm mới </h4>
							<div class="beta-products-details">
								<p class="pull-left">Tìm thấy{{count($new_product)}} sản  phẩm</p>
								<div class="clearfix"></div>
							</div>

							<div class="row">
@foreach($new_product as $new)								
								<div class="col-sm-3">
									<div class="single-item">
	@if($new->promotion_price!=0)
	<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
	@endif									
			<div class="single-item-header">
				<a href="{{route('chitietsanpham',$new->id)}}">
					<img src="frontend/image/product/{{$new->image}}" height="250" alt="">
				</a>
			</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$new->name}}
											<p class="single-item-price" style="font-size:18px">
										@if($new->promotion_price==0)
										<span class="flash-sale">{{number_format ($new->unit_price)}} đồng</span>
										@else
									   <span class="flash-del">	{{number_format($new->unit_price)}} đồng</span>
										<span class="flash-sale">{{number_format($new->promption_price)}}đồng</span>
										@endif
</p>		
											
										</div>
		<div class="space10">&nbsp;</div>								
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="them-vao-gio-hang/{{$new->id}}"><i class="fa fa-shopping-cart"></i></a>
				<a class="beta-btn primary" href="{{route('chitietsanpham',$new->id)}}">Chi Tiết <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
	<div class="space10">&nbsp;</div>										
										</div>
									</div>
								</div>

							
	@endforeach
							</div>
	<div class="row text-center">{{$new_product->appends(["norpage"=>$nor_product->currentPage()])-> links()}}</div>
						</div> <!-- .beta-products-list -->

@endsection