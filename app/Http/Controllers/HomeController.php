<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (\session('user')) {
            $url = 'https://rest.eurotorg.by/10301/Json?What=Postal.OfficesOut';

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_AUTOREFERER => true,
                CURLOPT_HTTPHEADER => array('Content-Type:application/json'),
                CURLOPT_URL => $url,
                CURLOPT_POSTFIELDS =>
                    '{"CRC":"","Packet":{"MethodName":"Postal.OfficesOut","JWT":null,"ServiceNumber":"E811AE79-DFDE-4F85-8715-DD3A8308707E","Data":{}}}',
                CURLOPT_USERAGENT => 'ctrlv cURL Request',
            ));
            $response = curl_exec($curl);
            curl_close($curl);

            $arr = json_decode($response);

            return view('home', [
                'offices' => $arr->Table
            ]);
        } else {
            return redirect()->route('login');
        }
    }

    public function login(Request $request) {
        if ($request->isMethod('post')) {
            if (Hash::check($request->input('password'), env('APP_PASS'))) {
                \session(['user' => true]);
                return redirect()->route('home');
            } else return redirect()->route('login')->with('error', 'Неверный пароль');
        }

        return view('login');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user');

        return redirect()->route('login');
    }

    public function password()
    {
        return Hash::make('123456');
    }
}
