<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Comment;

class HomeController extends Controller
{
    public function index(){
        $boards = Board::limit(5)->orderby('id','desc')->get();

        return view('index', compact('boards'));
    }
}
