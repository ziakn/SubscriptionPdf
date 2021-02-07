<?php

namespace App\Http\Controllers;

use App\PdfFile;
use App\CheckSession;
use Illuminate\Http\Request;
use Carbon\Carbon;
class PdfFileController extends Controller
{
    
    public function index()
    {
        $data = PdfFile::get();
        return response()->json($data);
    }

   
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {

            // return response()->json($request->all());
             
            //  $date1=$utc->format('Y-m-d H:s:i');
            // return  response()->json($date1);
             $find = CheckSession::where('user_id', $request->user_id)->first();
            if(!$find)
            {
                $create = CheckSession::create(
                    [
                        'user_id'=> $request->user_id,
                        'pdf_id'=> $request->pdf_id,
                        'flag'=> 'active',
                    ]);
                 return response()->json('http://pdf.localhost:8000/getpdf/'.urlencode(base64_encode($request->user_id)).'/'.urlencode(base64_encode($request->pdf_id)));
            }
            else
            {
                // $utc =Carbon::now('UTC');
                // $find = CheckSession::where('user_id', $request->user_id)->first();
                // $date2 = $find->updated_at->format('Y-m-d H:s:i');
                // $min_diff =  $find->updated_at->diffInMinutes($utc);
                // return  response()->json($min_diff);
                // if($min_diff >= 10)
                // {
                    // return '2';
                    CheckSession::where('user_id',$request->user_id)
                    ->update([
                        'user_id'=> $request->user_id,
                        'pdf_id'=> $request->pdf_id,
                        'flag'=> 'active',
                    ]);
                //     return response()->json('http://localhost:8000/getpdf/'.urlencode(base64_encode($request->user_id)).'/'.urlencode(base64_encode($request->pdf_id)));
                // }
                // else   
                // {
                     return response()->json('http://pdf.localhost:8000/getpdf/'.urlencode(base64_encode($request->user_id)).'/'.urlencode(base64_encode($request->pdf_id)));
                // }

            }

            
            
            
          
    }

   
    public function getpdf($user_id, $pdf_id)
    {

        
        $user_id=urldecode(base64_decode($user_id));
        $pdf_id=urldecode(base64_decode($pdf_id));
        $find = CheckSession::where('user_id', $user_id)->where('pdf_id', $pdf_id)->first();
        if(!$find)
        {       
                return 'Pdf Not Found';
        }
        else
        {   
            $utc =Carbon::now();
            // dd($utc);
            $min_diff =  $find->updated_at->diffInSeconds($utc);
             if($min_diff <= 0)
                {
                    $data = PdfFile::find($pdf_id);
                    $file = storage_path('app/public/'.$data->src);
                    $headers = [
                                    'Content-Type' => 'application/pdf'
                               ];
                    
                   return response()->download($file, 'Test File', $headers, 'inline');
                }
                else   
                {
                     return 'Dont Show PDF ! Beacuse of Session Expired'. $min_diff;
                }
        }
    }

   
    
}
