<?php


namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\Product\ProductService1;
use App\Http\Services\Slider\SliderService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use function Symfony\Component\Mime\Header\get;
use App\Http\Services\Product\ProductService;

class LoginCustomerController extends Controller
{
    protected $slider;
    protected $menu;
    protected $product;

    public function __construct(SliderService $slider, MenuService $menu,
                                ProductService1 $product)
    {
        $this->slider = $slider;
        $this->menu = $menu;
        $this->product = $product;
    }
    public function index()
    {
        return view('logincustomer',[
            'title' => 'Đăng nhập hệ thống'
        ]);
    }

    public function store1(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:filter',
            'password' => 'required'
        ]);

        if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ], $request->input('remember'))) {

            return redirect()->route('show-Profile');

        }

        Session::flash('error', 'Email hoặc Password không đúng');
        return redirect()->back();
    }
    public function showProfile()
    {
        return view('home2', [
            'title' => 'Shop thời trang',
            'sliders' => $this->slider->show(),
            'menus' => $this->menu->show(),
            'products' => $this->product->get()
        ]);
    }
    public function logout()
    {
        Auth::logout();
        return redirect()-> route('index');
    }
}
