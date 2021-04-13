<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Comment;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Comment::where('parent_id', 0)
                    ->with('user')
                    ->with('replies')
                    ->latest()
                    ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $postdata = $request->all();
        $maxDepth = 3;

        // before saving new comment, count the current depth of nested comments from root
        if ((int) $postdata['parent_id'] > 0) {
            $parentId = $postdata['parent_id'];
            $comment = Comment::with('parent')->find($parentId); // gets up to root
            $currentDepth = Helper::arrayDepth($comment->toArray(), 'parent');

            if ($currentDepth >= $maxDepth) {
                return response()->json([
                    'message' => "Nested comments are allowed up to $maxDepth layers only."
                ], 400);
            }
        }

        $comment = Comment::create($postdata);

        return $comment->toArray();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Comment::with('user')
            ->with('replies')
            ->latest()
            ->find($id);
    }
}
