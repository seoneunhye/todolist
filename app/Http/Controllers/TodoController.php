<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    // 전체조회
    public function index(){
        $todo = Todo::orderBy('created_at','desc')->get();
        return response()->json($todo);
    }
    // post
    public function create(Request $request){
        $title = $request ->input('title');
        $description = $request ->input('description');
        $is_completed = $request ->input('is_completed');

        $todo = new Todo();
        $todo->title = $title;
        $todo->description = $title;
        $todo->is_completed = $is_completed;
        $todo->save();
        
        return response()->json($todo);
    }
    // 개별조회
    public function read($id){
        // $todo = Todo::where('id',$id)->first();
        $todo = Todo::find($id);
        return response()->json($todo);
    }
    public function update(Request $request,$id){
        $todo = Todo::find($id);

        $title = $request->input('title');
        $description = $request->input('description');
        $is_completed = $request->input('is_completed');

        $todo->title = $title;
        $todo->description = $description;
        $todo->is_completed = $is_completed;
        $todo->save();

        return response()->json($todo);
    }
    public function delete($id){
        $todo = Todo::find($id);
        $todo->delete();
        return response()->json(['message'=>'삭제되었습니다.']);

    }
}
