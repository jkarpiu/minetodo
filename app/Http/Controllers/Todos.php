<?php

namespace App\Http\Controllers;

use Request;
use App\savedTodos;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\Environment\Console;

class Todos extends Controller
{
    public function show(Request $request)
    {
        if (Auth::user() !== null) {
            $todos = savedTodos::where('userId', Auth::user()->id)->orderBy('priority', 'asc')->orderBy('completed', 'asc')->orderBy('created_at', 'desc')->get();
            return response()->json($todos);
        } else {
            abort(401);
        }
    }
    public function add()
    {
        if (Auth::user() !== null) {
            $new = Request::only(['title', 'userId']);
            if ($new['userId'] == Auth::id()) {
                $todos = savedTodos::create([]);
                $todos->title = $new['title'];
                $todos->completed = false;
                $todos->userId = $new['userId'];
                $todos->save();
                return response()->json(true);
            } else
                abort(401);
        } else {
            abort(401);
        }
    }
    public function del()
    {
        if (Auth::user() !== null) {
            $delete = Request::only(['id', 'userId']);
            if ($delete['userId'] == Auth::id()) {
                savedTodos::where('id', $delete['id'])->delete();
            } else
                abort(401);
        } else {
            abort(401);
        }
    }
    public function done()
    {
        if (Auth::user() !== null) {
            $do = Request::only(['id', 'userId']);
            if ($do['userId'] == Auth::id()) {
                $previous = savedTodos::where('id', $do['id'])->get();
                $previous[0]->completed = !$previous[0]->completed;
                $change = savedTodos::where('id', $do['id'])->update(['completed' => $previous[0]->completed]);
            } else
                abort(401);
        } else {
            abort(401);
        }
    }
}
