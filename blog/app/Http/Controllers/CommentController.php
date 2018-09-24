<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\TinTuc;
use App\Comment;
class CommentController extends Controller
{
    //
    public function getXoa($id,$idTinTuc){
            $comment = Comment::find($id);
            $comment->delete();
            return redirect('admin/tintuc/edit/'.$idTinTuc)->with('thongbao','Delete comment success');
    }
}
