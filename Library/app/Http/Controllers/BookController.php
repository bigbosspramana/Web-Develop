<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//import model product
use App\Models\Book; 

//import return type View
use Illuminate\View\View;

class BookController extends Controller
{
     /**
     * index
     *
     * @return void
     */
    public function index() : View
    {
        //get all products
        $books = Book::latest()->paginate(10);

        //render view with products
        return view('index', compact('books'));
    }
}

