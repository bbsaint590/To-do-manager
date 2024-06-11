<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Todo;
use Illuminate\Http\Request;
class TodosAPIController extends Controller
{
    public function toDos(Request $request)
    {
        if (isset($request->completed)) {
            $toDos = Todo::with('category')->where('completed', '=', $request->completed)->get();
        } else {
            $toDos = Todo::with('category')->get();
        }

        return response()->json([
            'message' => 'Selected todo items found successfully.',
            'success' => true,
            'data' => $toDos,
        ]);
    }
    public function singleToDos(int $id)
    {
            $toDos = Todo::find($id);

            return response()->json([
                'message' => 'Todo item found successfully.',
                'success' => true,
                'data' => $toDos,
            ]);

    }
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'category_id' => 'required|integer|exists:categories,id',
        ]);

        $toDo = new Todo();
        $toDo->name = $request->name;
        $toDo->category_id = $request->category_id;

        $toDo->save();

        return response()->json([
            'message' => 'Todo added to the DB',
            'success' => true
        ]);
    }
    public function delete(Request $request)
    {
        $toDo = Todo::find($request->id);

        if ($toDo) {
            $toDo->delete();

            return response()->json([
                'message' => 'Todo item deleted successfully.',
                'success' => true
            ]);
        } else {
            return response()->json([
                'message' => 'Todo item not found.',
                'success' => false
            ]);
        }
    }
    public function update(int $id, Request $request)
    {
        $toDo = Todo::find($id);

        $toDo->id = $request->id;
        $toDo->completed = $request->completed;
        $toDo->name = $request->name;
        $toDo->category_id = $request->category_id;
        $toDo->save();

        if (!$toDo) {
            return response()->json([
                'message' => 'Todo item not found.',
                'success' => false
            ]);
        } else {
            return response()->json([
                'message' => 'Todo item updated successfully.',
                'success' => true
            ]);
        }
    }

//    public function completedTasks(Request $request)
//    {
//        if (isset($request->completed)) {
//            $toDos = Todo::where('completed', '=', $request->completed)->get();
//        } else {
//            $toDos = Todo::all();
//        }
//        return response()->json([
//            'message' => 'Todo completed items found successfully.',
//            'success' => true,
//            'data' => $toDos
//        ]);
//    }
}
//    public function filterByCategory(Request $request)
//    {
//        $toDos = Todo::with(['category'])->get();
//        if (isset($request->name['category'])) {
//            $toDos = Todo::where('category', '=', $request->category_id->name)->get();
//        } else {
//            $toDos = Todo::all();
//        }
//        return response()->json([
//            'message' => 'Todo completed items found successfully.',
//            'success' => true,
//            'data' => $toDos
//        ]);
//    }
//};





