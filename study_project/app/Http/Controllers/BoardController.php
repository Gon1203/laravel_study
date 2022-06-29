<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use DB;


class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boards = Board::latest() -> paginate(5);
        return view('Board.index', compact('boards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(! Auth::check()){
            return redirect()->route('login.show');
        }else{

            return view('Board.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $board = $request -> validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        Board::create($request->all());

        return redirect() -> route('board.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function show(Board $board)
    {

        $comments = Board::find($board->id)->comments;
        return view('Board.show', compact('board', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function edit(Board $board)
    {
        return view('Board.edit', compact('board'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Board $board)
    {
        if(! Gate::allows('change_board', $board)){
            abort(403);
        }

        $validate = $request->validate([
            'title' => 'required',
            'writer' => 'required',
            'content' => 'required'
            ]);

        $targetBoard = Board::where('id', $board->id)->first();

        echo($board->id);

        $targetBoard->title = $validate['title'];
        $targetBoard->writer = $validate['writer'];
        $targetBoard->content = $validate['content'];

        $targetBoard -> save();

        return redirect()->route("board.index") -> with('message', "Board Update Success");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function destroy(Board $board)
    {
        if(! Gate::allows('change_board', $board)){
            abort(403);
        }
        DB::beginTransaction();
        $comments = Comment::where('board_id', $board->id)->get();
        foreach ($comments as $comment) {
            $comment -> delete();
        }
        $board -> delete();
        DB::commit();
        return redirect()->route("board.index") -> with('message', "Board Delete Success");
    }
}
