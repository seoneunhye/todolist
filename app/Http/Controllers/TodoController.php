<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Todo;

class TodoController extends Controller
{
    // 투두 전체 목록 조회
    public function index(){
        $todo = Todo::all();
        return response()->json($todo);
    }
    // 투두 등록하기
    public function create(Request $request){

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:15',
            'description' => 'required|max:100'
        ], [
            'title.required' => '필수 값입니다.',
            'description.required' => '필수 값 입니다.',
            'title.max' => 'title 은 최대 15자 까지 입력 가능합니다.',
            'description.max' => 'description 은 최대 100자까지 입력 가능합니다.'
        ]);

        // 유효성 검사 수행
        if($validator ->fails()){
            return response()->json(['error'=>$validator->errors()],422);
        }

        // 유효성 검사를 통과한 데이터 가져옴
        $validatedData = $validator->validated();
        // is_completed 항목 false 로 기본값 설정
        $validatedData['is_completed'] = false;
        // 유효성 검사를 통과한 데이터로 새 Todo 객체를 생성
        $todo = Todo::create($validatedData);

        // 생성된 Todo 객체를 JSON 형식으로 반환하며, 상태 코드 201(Created) 전송
        return response()->json($todo, 201);

    }
    // 개별 조회
    public function read($id){
        $todo = Todo::find($id);
        if(!$todo){
            return response()->json(['error'=>'해당 투두를 찾을 수 없습니다.'],404);
        }
        return response()->json($todo);


    }
    public function update(Request $request,$id){
        $todo = Todo::find($id);

        if(!$todo){
            return response()->json(['error'=>'해당 투두를 찾을 수 없습니다.'],404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'max:15',
            'description' => 'max:100',
            'is_completed' => 'boolean'
        ], [
            // 기타 필드별 유효성 검사 메시지
            'title.max' => 'title 은 최대 15자 까지 입력 가능합니다.',
            'description.max' => 'description 은 최대 100자까지 입력 가능합니다.',
            'is_completed.boolean' => 'is_completed 는 boolean 값이어야 합니다.'
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 422);
        }
        $validatedData = $validator->validated();
        $todo->update($validatedData);
        return response()->json($todo, 200);
       
    }
    public function delete($id)
    {
        $todo = Todo::find($id);
        if(!$todo){
            return response()->json(['error'=>'해당 투두를 찾을 수 없습니다.'],404);
        }
        // Todo를 삭제합니다.
        $todo->delete();
        return response()->json(['message' => 'todo 목록이 성공적으로 삭제되었습니다.']);
    
    }
}
