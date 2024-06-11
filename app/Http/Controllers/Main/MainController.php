<?php

namespace App\Http\Controllers\Main;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use App\Models\User;
use App\Models\Session;
use App\Traits\ResponseTrait;

class MainController extends Controller
{
    use ResponseTrait;
    public function index(): Renderable
    {
        return view('index');
    }
    public function about(): Renderable
    {
        return view('about');
    }
    public function parties(): Renderable
    {
        return view('parties');
    }
    public function brands(): Renderable
    {
        return view('brands');
    }
    public function hunters(): Renderable
    {
        return view('hunters');
    }
    public function faqs(): Renderable
    {
        return view('faqs');
    }
    public function privacy(): Renderable
    {
        return view('privacy');
    }
    public function term(): Renderable
    {
        return view('term');
    }
    public function contact(): Renderable
    {
        return view('contact');
    }
    public function login(): Renderable
    {
        return view('login');
    }
    public function dashboard()
    {
        
        $user =  User::where('id',auth()->user()->id)->with('wallet')->first();
        $session = Session::with('game')->get();
        //return $this->responseSuccess($session, 'Event List Fetched Successfully !');
        return view('dashboard',compact('user','session'));
    }
    
}
