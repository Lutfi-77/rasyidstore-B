<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //

    public function store(Request $request)
    {
        $comment = new Comments;

        $comment->user_id = Auth()->user()->id;
        $comment->comment = $request->comment;
        $comment->prod_variant_id = $request->prod_variant_id;
        $comment->save();
        return redirect()->back();
    }
}
