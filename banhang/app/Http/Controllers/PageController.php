<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Slide;
use App\Models\Products;
use App\Models\Type_Products;
use App\Models\Bills_Detail;
use App\Models\Cart;
use App\Models\Bills;
use App\Models\Customer;
use App\Models\User;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;




class PageController extends Controller
{
    public function getIndex()
    {
        $slide = Slide::all();
        $sospm = Products::where("new","=",1)->count();
        $sospb = Products::where("new","=",0)->count();
        $new_product = Products::Where("new","=",1)->paginate(4,'*',"newpage");
        $nor_product = Products ::where("new","=",0) ->paginate(8,'*',"norpage");
        return view("Pages.trangchu", compact("slide","new_product","sospm","nor_product","sospb"));
    }



    public function getLoaiSanPham($id)

    {
        $loai = Type_Products::where("id","=",$id)->first();
        $danhsach_loai = Type_Products::all();
        $sanpham_theoloai = Products::where("id_type","=",$id)->get();
        $sanpham_khac = Products::where("id_type","!=",$id)->paginate(6);
    return view("Pages.loai_sanpham",compact("loai","danhsach_loai","sanpham_theoloai","sanpham_khac"));
       
    }
    public function getChiTietSanPham(Request $req)
    {

        $sanpham = Products::where("id",$req->id)->first();
        $sanpham_tuongtu = Products::where("id_type","=",$sanpham->id_type)->paginate(3);
        return view("Pages.chitiet_sanpham",compact("sanpham","sanpham_tuongtu"));
    }
    public function getLienHe()
    {
        return view("Pages.Lienhe");
    }
    public  function getGioiThieu()
    {
        return view("Pages.Gioithieu");
    }

    public function getThemVaoGioHang(Request $req,$id)
    {
        $sanpham = Products::find($id);
        $oldcart = Session('cart') ? Session::get('Cart') : null;
        $cart=new  Cart($oldcart);
        $cart->add($sanpham,$id);
        $req->session()->put('cart',$cart);
        return redirect()->back();
    }

    public function getXoaGioHang($id)
    {
        $oldcart = Session('cart') ? Session::get('cart') : null;
        $cart    = new Cart($oldcart);
        $cart->reduceByOne($id);
        if(count($cart->items)>0)
        {
            Session::put('cart');
        }
        else    {
            Session::forget("cart");
        }
        return redirect()->back();
    
    }

    public function getDatHang()
    {
        return view("Pages.dathang");
    }
    public function postDathang(Request $req)
    {
        $cart = Session::get('cart');

        $cus  = new Customer;
        $cus->name = $req->name;
        $cus->gender = $req->gender;
        $cus->email = $req->email;
        $cus->address = $req->address;
        $cus->phone_number = $req->phone_number;
        $cus->note = $req->notes;
        $cus->save();

        $bill = new Bills;
        $bill->id_customer = $cus->id;
        $bill->date_order = date('Y-m-d');
        $bill->total = $cart->totalPrice;
        $bill->payment = $req->payment_method;
        $bill->note = $req->notes;
        $bill->save();

        foreach($cart->items  as $key->value)
        {
            $bd = new Bills_Detail();
            $bd->id_bill = $bill->id;
            $bd->id_product = $key;
            $bd->quantity =$value['qty'];
            $bd->unit_price = ($value['price']/ $value['qty']);
            $bd->save();
        }
        Session::forget("cart");
        return view("Pages.thongbao");
    
    }
         public function getDangNhap()
         {
            return view("Pages.dangnhap");
         } 

         public function postDangNhap(Request $req)
         {
            $this->validate($req,
            [
                'email' =>'required|email|',
                'password' =>'required|min:6|max:20',

            ],
            [
                'email.required'=>"Chưa nhập địa chỉ thư",
                'email.email'   => 'Địa  chỉ  thư  không  đúng  định dạng',
                'password.required'=>'Chưa  nhập mật khẩu',
                'password.min'  => 'Mật  khẩu tối  thiểu 6 ký tự',
                'password.max'  => 'Mật  khẩu tối  đa 20 ký tự',
            ]);
            $chungthuc = array('email'=> $req->email,'password'=> $req->password);
            if (Auth::attempt($chungthuc)) {
                return redirect("index");
            } else {
                return redirect()->back()->with(['matb'=>'0','noidung'=>'Đăng nhập thất bại']);
            }
         }

         public function getDangKy()
         {
            return view("Pages.dangky");
         }

         public function postDangKy(Request $req)
         {
            
         $val = $req->validate([
                'email'  => 'required|email|unique:users',
                'password' => 'required|min:6|max:20',
                'repassword' => 'required|same:password',
                'address'    => 'required',
                'fullname'   => 'required',
                'phone'      => 'required' 
            ],[
                'email.required' => 'Vui lòng nhập địa chỉ  thư',
                'email.email'    => 'Địa  chỉ thư không đúng  định dạng',
                'email.unique'   => 'Email này  đã có người đăng kí',
                'password.required' => 'Chưa nhập  mật khẩu',
                'password.min'    => 'Mật khẩu  tối thiểu  6 kí tự',
                'password.max'   => 'Mật khẩu  tối đa  20 kí tự',
                'repassword.required'   => 'Chưa nhập lại mật khẩu',
                'repassword.same'   => 'Mật khẩu không khớp',
                'address.required' => 'Chưa nhập  địa chỉ',
                'fullname.required' =>'Chưa nhập họ  tên',
                'phone.required'    => 'chưa nhập  điện  thoại'
            ]);
          
            $user = new User();
            $user->full_name = $val["fullname"];
            $user->email = $val["email"];
            $user->password = Hash::make($val["password"]);
            $user->address = $val["address"];
            $user->phone = $val["phone"];
            $user->save();
            return redirect()->back()->with("thongbao","Đăng ký thành công");
         }

         public function getDangXuat()
         {
            Auth::logout();
            return redirect("index");
         }

         public function getTimKiem(Request $req)
         {
            $product = Product::where("name","like","%".$req."%")
                              ->orWhere("unit_price","$req->key")
                              ->get();
            return view("Pages.timkiem",compact("product")) ;                 
         }


        
                         
         }
        
            
                
           
