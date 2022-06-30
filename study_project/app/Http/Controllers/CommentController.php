<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use DB;


class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'writer'=>'required',
            'content'=>'required',
            'board_id'=>'required',
        ]);

        $mode = $request->mode;
        if($mode == '0'){
            $comment = new Comment();

            $comment->board_id = (int) $request->get('board_id');
            $comment->content = $request->get('content');
            $comment->writer = $request->get('writer');
            $comment->order = '0';
            $comment->depth = '0';
            $comment->save();
            $comment->group_id = $comment->id;
            $comment->save();

            return back();

        } else {
            $reply = new Comment();

            $motherComment = Comment::findOrFail($request->comment_id);
            $reply->board_id = $request->board_id;
            $reply->content = $request->content;
            $reply->writer = $request->writer;
            $reply->order = $motherComment->order + 1;
            $reply->depth = Comment::where('group_id',$request->group_id)->max('depth')+1;
            $reply->group_id = $request->group_id;
            $reply->save();
        }



        return back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        DB::beginTransaction();
        $comment = Comment::where('id', $id)->first();
        $comment -> delete();
        // where 조건절을 사용하며 여러개의 레코드를 조회할 때는 all()는 작동 X
        // get()을 사용하면 조건절과 함께 여러 레코드 조회 가능
        // return은 컬렉션 타입으로 리턴됨
        $replys = Comment::where('group_id', $comment->group_id)->get();
        foreach ($replys as $reply ) {
            $reply -> delete();
        }
        DB::commit();

        return back();



    }
}
