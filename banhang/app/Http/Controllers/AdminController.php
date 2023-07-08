<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Type_Products;
use App\Models\Bills;
use App\Models\Bills_Detail;
use App\Models\Customer;

class AdminController extends Controller
{
    public function getLoginAdmin()
    {
        return view("admin.dangnhap");
    }

    public function postLoginAdmin(Request $req)
    {
       $val = $req->validate(
     
        [
        'email' => 'required|email',
        'password' => 'required|min:6|max:20'
        ],
        [
        'email.required' => "chưa nhập địa chỉ mail",
        'email.email' => "Địa chỉ mail không đúng định dạng",
        'password.required' => 'Chưa nhập mật khẩu',
        'password.min' => 'mật khẩu tối thiểu 6 ký tự',
        'password.max' => 'mật khẩu tối đa 20 ký tự'
        ]);
        $chungthuc = array('email' => $req->email, 'password' => $req->password);

        if (Auth::attempt($chungthuc)) 
        {
            return redirect("admin/lietkedonhang");
        } 
        else 
        {

        return redirect()->back()->with(['matb' => '0', 'noidung' => 'Đăng nhập thất bại']);

        }
    }
    
    public function getLogoutAdmin()
    {
        Auth::logout();
        return redirect("login");
    }

    public function getUserInfo()
    {
        if(Auth::check())
        {
            return view("admin/thongtin");
        }
        return redirect("login");
    }

    public function getProducttype()
    {
    if (Auth::check()) {
            $loai_sp = ProductType::paginate(5);
            return view("admin.danhsachloai", compact("loai_sp"));   
        }
    else 
    {
            return view("admin.dangnhap");
        }
    }
   
    public function postAddProducttype(Request $req)
    {
        $validateData = $req->validate(
        [        
            'name' =>"required",
            'description' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ],
        [
            'name.required' =>"Chưa nhập  tên loại sản phẩm",
            'description.required' =>"Chưa  nhập mô tả  loại sản phẩm",
            "image.required" => "Chưa  chon loại hình  sản phẩm",
            "image.mimes" => "Chọn tập  tin:jpg,png,gif,svg"
        ]);
        $filename = $req->file("image")->getClientOriginalName();
        $prot = new ProductType;
        $prot->name = $req->name;
        $prot->description = $req->description;
        $prot->image = $filename;
        $prot->save();
        $path = $req->file('image')->move('frontend/image/product',$filename);
        return redirect()->back()->with("thongbao","Thêm loại sản phẩm thành công");    
    }
 
   
    
    public function getEditProducttype($id)
    {
        if (Auth::check()) 
            {
                $loai_sp = ProductType::find($id);
                return view("admin.sualoaisanpham", compact("loai_sp"));
            }
        else 
        {
            return view("admin.dangnhap");
            }
    }
   
    public function postEditProducttype(Request $req ,$id)
    {
      $loai_sp = ProductType::find($id);
      $this->validate($req,
        [        
            'name' =>"required",
            'description' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ],
        [
            'name.required' =>"Chưa nhập  tên loại sản phẩm",
            'description.required' =>"Chưa  nhập mô tả  loại sản phẩm",
            "image.required" => "Chưa  chon loại hình  sản phẩm",
            "image.mimes" => "Chọn tập  tin:jpg,png,gif,svg"
        ] );
        $filename = $req->file("image")->getClientOriginalName();
        $loai_sp->name = $req->name;
        $loai_sp->description = $req->description;
        $loai_sp->image = $filename;
        $loai_sp->save();
        $path = $req->file('image')->move('frontend/image/product',$filename);
        return redirect()->back()->with("thongbao","Thêm loại sản phẩm thành công");
    }

    public function getDeleteProducttype($id)
    {
        $loai_sp = ProductType::find($id);
        $loai_sp->delete();
        return redirect("admin/danhsachloai")->with("thongbao","Đã  xóa thành công");
    }

    public function getBills()
    {
        if (Auth::check()) 
        {
        $donhang = Bills::join('customer','customer.id',"=",'bills.id_customer')->get();
        return view("admin.danhsachdonhang", compact("donhang"));
        }
        else 
        {
            return view("admin.dangnhap");
        } 
    }
    public  function getEditBills($id)
    {
        $dhg = Bills::find($id);
        $cus = Customer::find($dhg->id_customer);
        $ct_dhg = Bills_Detail::where("id_bill","=",$dhg->id)
                               -> join("products","products.id","=","Bill_detail.id_product")
                               ->get(['products.name','bill_detail.quantity','bill_detail.unit_price']);
        return view("admin.chitietdonhang",compact("dhg","cus","ct_dhg")); 
    }

    public  function postEditBills(Request $req,$id)
    {
        $dhg = Bills::find($id);
        $dhg->state  = $req->state;
        $dhg->save();
        return redirect()->back()->with("thongbao" ,"Đã cập nhật đơn  hàng");

    }



   
     
    
    public function getCustomer()
    {
       if(Auth::check())
       {
        $customer =  Customer::all();
            return view("admin.lietkekhachhang",compact("customer")) ;                 
        }   
        else{
       return view("admin.dangnhap");  
        }
   }
   
   public function deleteCustomer($id)
    {
       $cusnum = Bill::where("id_customer" ,"=" ,$id)->count();
       if ($cusnum ==0){
           $cus = Customer::find($id);
           $cus->delete();
           return redirect()->back()->with("thongbao","Đã  xóa khách  hàng thành  công");
       }
       else
       {
           return redirect()->back()->with("thongbao","khách hàng  đã  xóa  đơn  hàng  thành  công");
       
                    
        }          
      
    }

}
    