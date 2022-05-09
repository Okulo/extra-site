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
        return view('show');
    }

}
