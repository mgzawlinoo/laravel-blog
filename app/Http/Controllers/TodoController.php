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
        $data = DB::table('todos')->get()->sortByDesc('created_at');
        return view('todos.index', ['todos' => $data]);
    }

    // function for search
    public function search() {
        $q = request('q');
        $data = DB:: table('todos')->where('name', 'like', "%{$q}%")->get();
        return view('todos.index', ['todos' => $data, 'q' => $q]);
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

    public function update(Request $request, $id) {

        $request->validate([
            'name' => 'required|string|max:255|min:8',
            'completed' => 'integer|in:0,1'
        ]);

        $todo = Todo::find($id);
        $todo->name = $request->name;
        $todo->completed = $request->completed ? true: false;
        $todo->update();

        return redirect()->route('todos.index')->with('success', 'Todo updated successfully');
    }

    public function status($id) {
        $todo = Todo::find($id);
        $todo->completed = !$todo->completed;
        $todo->update();

        return redirect()->route('todos.index');
    }

    public function destroy($id) {
        $todo = Todo::find($id);
        $todo->delete();
        return redirect()->route('todos.index' )->with('success', 'Todo deleted successfully');
    }

}
