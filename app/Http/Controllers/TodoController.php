<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{
    public function index()
    {
        // $data = Todo::all(); // eloquent orm
        $data = Todo::orderBy('updated_at', 'desc')->paginate(5);
        return view('todos.index', ['todos' => $data]);
    }

    public function show() {

    }

    public function create() {
        return view('todos.create');
    }

    public function store(Request $request) {

        $request->validate([
            'name' => 'required|string|max:255|min:8',
            'completed' => 'integer|in:0,1'
        ]);

        // ဒီ ပုံစံက Todo model ကနေ ဒေတာထည့်တဲ့ ပုံစံ , Model ဘက်မှာ fillable နဲ့ ထပ်ခံထားတယ်
        Todo::create($request->all());

        // $todo = new Todo;
        // $todo->name = $request->name;
        // $todo->completed = $request->completed ? true: false;
        // $todo->save();

        return redirect()->route('todos.index')->with('success', 'Todo created successfully');
    }

    public function edit($id) {
        $todo = Todo::find($id);
        return view('todos.edit', ['todo' => $todo]);
    }

    public function update(Request $request, Todo $todo) {

        $request->validate([
            'name' => 'required|string|max:255|min:8',
            'completed' => 'integer|in:0,1'
        ]);

        $todo->completed = $request->completed ? true: false;
        $todo->update($request->all());

        return redirect()->route('todos.index')->with('success', 'Todo updated successfully');
    }

    public function status($id) {
        $todo = Todo::find($id);
        $todo->completed = !$todo->completed;
        $todo->update();

        return redirect()->route('todos.index');
    }

    public function destroy(Todo $todo) {
        $todo->delete();
        return redirect()->route('todos.index' )->with('success', 'Todo deleted successfully');
    }

}
