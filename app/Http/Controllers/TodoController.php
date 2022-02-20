<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return index view
     */
    public function index()
    {
        $todos = Todo::all();
        return view('index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return create view
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return redirect to / with success message
     */
    public function store(Request $request)
    {
        $storeData = $request->validate([
            'task' => 'required|max:255',
        ]);
        $todos = Todo::create($storeData);
        return redirect('/')->with('success', 'Task has been stored');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return edit view
     */
    public function edit($id)
    {
        $todos = Todo::findOrFail($id);
        return view('edit', compact('todos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return redirect to / with success message
     */
    public function update(Request $request, $id)
    {
        $updateData = $request->validate([
            'task' => 'required|max:255',
        ]);
        Todo::whereId($id)->update($updateData);
        return redirect('/')->with('success', 'Task has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return redirect to / with success message
     */
    public function destroy($id)
    {
        $todos = Todo::findOrFail($id);
        $todos->delete();
        return redirect('/')->with('success', 'Task has been deleted');
    }
}
