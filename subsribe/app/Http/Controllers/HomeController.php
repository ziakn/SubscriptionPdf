<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $client = new \GuzzleHttp\Client();
        $data = $client->get('http://pdf.localhost:8000/api/pdflist');
        // return $response['data'] = $data->getBody();
        // $data =$a->getBody();

        return view('home', ["data" => json_decode($data->getBody())]);
    }

    public function show(Request $request)
    {
        // dd($request->all());
        $auth_id=Auth::id();
        $client = new \GuzzleHttp\Client();
        $data = $client->request('POST', 'http://pdf.localhost:8000/api/pdf', [
                     'form_params' => [
                        'pdf_id' => $request->id,
                        'user_id' => $auth_id,
                     ]
                     ]);
            
        // return Redirect::to(json_decode($data->getBody()));

        return view('showpdf', ["data" => json_decode($data->getBody())]);
        // dd($id);
    }
}
