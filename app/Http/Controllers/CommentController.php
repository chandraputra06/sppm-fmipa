<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::get();
        return response()->json([
            'data'=>$comments,
            'message'=> 'Success get data comments'
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        DB::beginTransaction();
        try {
            $comments = Comment::create([
                'content'=>$request->content,
                'user_id'=>$request->user_id,
            ]);
            DB::commit();
            return response()->json([
                'data'=>$comments,
                'message'=>'Success create comment'
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message'=>'Failed create comment',
                'error'=>$th->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        DB::beginTransaction();
        try {
            $comment->update([
                'content'=>$request->content,
            ]);
            DB::commit();
            return response()->json([
                'data'=>$comment,
                'message'=>'Success update comment'
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message'=>'Failed update comment',
                'error'=>$th->getMessage()
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        DB::beginTransaction();
        try {
            $comment->delete();
            DB::commit();
            return response()->json([
                'message'=>'Success delete comment'
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message'=>'Failed delete comment',
                'error'=>$th->getMessage()
            ], 400);
        }
    }
}
