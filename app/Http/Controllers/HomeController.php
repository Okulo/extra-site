<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Form;
use App\Models\FormData;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function saveForm(Request $request){

        $from = Board::create([
            'name' => $request->name,
            'photo' => $request->photo,
            'price' =>  $request->price
        ]);
        return $from;
    }

    public function addBoard(){
        // полученные данные передаем в вид
        return view('show');
    }

    public function getBoards(){
        $all = Board::all();
        return $all;
    }

    public function getBoard(Request $request){
        $form = Board::where('id', $request->id)->first();
        return  $form;
    }
    public function show(){
        return view('show');
    }

}
