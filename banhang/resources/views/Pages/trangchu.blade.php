@extends("layouts.master")
@section("content")
</div> <!-- #header -->
	<div class="rev-slider">
	<div class="fullwidthbanner-container">
					<div class="fullwidthbanner">
						<div class="bannercontainer" >
					    <div class="banner" >
								<ul>
	@foreach($slide as $sl)								
									<!-- THE FIRST SLIDE -->
									<li data-transition="boxfade" data-slotamount="20" class="active-revslide" style="width: 100%; height: 100%; overflow: hidden; z-index: 18; visibility: hidden; opacity: 0;">
						            <div class="slotholder" style="width:100%;height:100%;" data-duration="undefined" data-zoomstart="undefined" data-zoomend="undefined" data-rotationstart="undefined" data-rotationend="undefined" data-ease="undefined" data-bgpositionend="undefined" data-bgposition="undefined" data-kenburns="undefined" data-easeme="undefined" data-bgfit="undefined" data-bgfitend="undefined" data-owidth="undefined" data-oheight="undefined">
													<div class="tp-bgimg defaultimg" data-lazyload="undefined" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat" data-lazydone="undefined" src="frontend/image/slide/{{$sl->image}}" data-src="frontend/image/slide/{{$sl->image}}" style="background-color: rgba(0, 0, 0, 0); background-repeat: no-repeat; background-image: url('frontend/image/slide/{{$sl->image}}'); background-size: cover; background-position: center center; width: 100%; height: 100%; opacity: 1; visibility: inherit;">
													</div>
												</div>

						        </li>
@endforeach
								</ul>
							</div>
						</div>

						<div class="tp-bannertimer"></div>
					</div>
				</div>
				<!--slider-->
	</div>
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

						<div class="space20">&nbsp;</div>

						<div class="beta-products-list">
							<h4>Sản Phẩm Bình  Thường</h4>
							<div class="beta-products-details">
								<p class="pull-left">Tìm thấy{{$sospb}}sản phẩm</p>
								<div class="clearfix"></div>
							</div>
							<div class="row">
	@foreach($nor_product as $normal)
								<div class="col-sm-3">
									<div class="single-item">
	@if($normal->promotion_price!=0) 																																																																																																																																																																																																																															
									<div  class="ribbon-wrapper">
										<div class="ribbon sale">Sale</div>
								</div>
								@endif

										<div class="single-item-header">
		<a href="{{route('chitietsanpham',$normal->id)}}"><img src="frontend/image/product/{{$normal->image}}" height="250" alt="{{$normal->image}}"></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$normal->name}}</p>
											<p class="single-item-price">
												@if($normal->promotion_price==0)
												<span  class="flash-sale">{{$normal->unit_price}}</span>
												@else
												<span  class="flash-del">{{$normal->unit_price}}</span>
												<span  class="flash-sale">{{$normal->promotion_price}}</span>

												
												@endif
										</p>	
										</div>
										<div class="space10">&nbsp;</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="them-vao-gio-hang/{{$normal->id}}"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="{{route('chitietsanpham',$normal->id)}}">Chi  tiết <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
											<div  class="space10">&nbsp;</div>
										</div>
									</div>
								</div>
@endforeach
							</div>
	<div  class="row text-center">{{$nor_product-> appends(["newpage"=>$new_product->currentPage()])-> links()}}</div>
							
									
						
>					</div> <!-- .beta-products-list -->
					</div>
				</div> <!-- end section with sidebar and main content -->


			</div> <!-- .main-content -->
		</div> <!-- #content -->
	</div> <!-- .container -->


@endsection



