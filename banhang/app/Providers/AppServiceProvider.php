<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Type_Products;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register():void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot():void
    {
        //
        Paginator::useBootstrap();
        view()->composer("layouts.header",function($view){
            $loai_sanpham = Type_Products::all();
            $view->with("loai_sanpham",$loai_sanpham);

        });

        view()->composer(["layouts.header","Pages.dathang"],function($view){
            if(Session('cart')) {
                $oldcart = Session::get('cart');
                $cart    = new Cart($oldcart);
                $view->with(['cart'=> Session::get('cart'),'product_cart'=>$cart->items,'totalprice'=>$cart->totalPrice,
                'totalqty'=>$cart->totalQty]);
            }
        });   
    }
}

  


