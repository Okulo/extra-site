<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function saveForm(Request $request){

        $from = Form::create([
            'uid' => $request->formUid,
            'name' => $request->formName,
            'fields' =>  json_encode($request->formData)
        ]);
        return $from;
    }

    public function formData(){

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://data/api/v1/endpoint',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{"jsonrpc":"2.0",
            "method":"form@ping",
            "params":{"type": "getData", "data": {
                "formId": 15,
                "name":"bla",
                "formType": "bla"
                }
                },
            "id":1
            }',
                        CURLOPT_HTTPHEADER => array(
                            'Content-Type: text/plain'
                        ),
                    ));
        $response = curl_exec($curl);

        curl_close($curl);

        // полученные данные передаем в вид
        return view('show');
    }

}
