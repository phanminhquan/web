<?php


namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash as FacadesHash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register',[
            'title' => 'Đăng ký hệ thống'
        ]);
    }
    public function registerUser(Request $request){

        $data = $request->all();

        User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>FacadesHash::make($data['password']),
        ]);
        return redirect('register')->with('success', 'Đăng ký thành công');

    }
}
