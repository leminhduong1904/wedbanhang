<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get("/index",[PageController::class,"getIndex"])->name("index");
Route::get("/loai-san-pham/{id}",[PageController::class,"getLoaiSanPham"])->name("loaisanpham");
Route::get("/chi_tiet_san_pham/{id}",[PageController::class,"getChiTietSanPham"])->name("chitietsanpham");
Route::get("/lien_he",[PageController::class,"getLienHe"])->name("lienhe");
Route::get("/gioi_thieu",[PageController::class,"getGioiThieu"])->name("gioithieu");

Route::get("them-vao-gio-hang/{id}",[PageController::class,"getThemVaoGioHang"]);
Route::get("xoa-gio-hang/{id}",[PageController::class,"getXoaGioHang"]);

Route::get("/dat-hang",[Pagecontroller::class,"getDathang"]);
Route::post("/dat-hang",[Pagecontroller::class,"getDathang"]);

Route::get("/dang-nhap",[Pagecontroller::class,"getDangNhap"]);
Route::post("/dang-nhap",[Pagecontroller::class,"getDatNhap"]);
Route::get("/dang-ky",[Pagecontroller::class,"getDangKy"]);
Route::post("/dang-ky",[Pagecontroller::class,"postDangKy"]);

Route::get("/dang-xuat",[Pagecontroller::class,"getDangXuat"]);

Route::get("/tim-kiem",[Pagecontroller::class,"getTimKiem"]);

Route::group(["prefix" => "admin"], function(){
   
    Route::get("/thongtin",[AdminController::class,"getUserInfo"]);
    Route::get("/danhsachloai",[AdminController::class,"getProductType"]);

    Route::get("/themloaisp",[AdminController::class,"getAddProducttype"]);
Route::post("/themloaisp",[AdminController::class,"postAddProducttype"]);
Route::get("/sualoaisp/{id}",[AdminController::class,"getEditProducttype"]);
Route::get("/sualoaisp/{id}",[AdminController::class,"postEditProducttype"]);
Route::get("/xoaloaisp/{id}",[AdminController::class,"getDeleteProductType"]);

Route::get("/lietkedonhang",[AdminController::class,"getBills"]);
Route::get("/capnhatdonhang/{id}",[AdminController::class,"getEditBills"]);
Route::post("/capnhatdonhang/{id}",[AdminController::class,"postEditBills"]);

Route::get("/danhsachkh",[AdminController::class,"getCustommer"]);
Route::get("/xoakhachhang/{id}",[AdminController::class,"deleteCustomer"]);
});

Route::get("/login",[AdminController::class,"getLoginAdmin"]);
Route::post("/login",[AdminController::class,"postLoginAdmin"]);
Route::get("/dangxuat",[AdminController::class,"getLogoutAdmin"]);



