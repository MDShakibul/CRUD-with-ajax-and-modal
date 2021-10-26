<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{

    public function index()
    {
        return view('create');
    }


    public function store(Request $request)
    {


        $request->validate([
            'name' => 'required',
            'auther_name' => 'required',
            'description' => 'required',
        ]);

        $input = $request->all();

        Book::create($input);
        return response()->json(['success'=>'Data is successfully added']);
    }
}
