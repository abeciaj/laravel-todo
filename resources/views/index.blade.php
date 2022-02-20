{{-- The home directory --}}

@extends('layout')
@section('content')
<style>
  .push-top {
    margin-top: 50px;
  }
</style>

{{-- Alert if success is returned --}}

<div class="push-top">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <div class="d-flex justify-content-center">
      <h1>Todo App</h1>
    </div><br>
  
{{-- table listing all data in database table --}}

  <table class="table">
    <thead>
        <tr class="table-warning">
          <td>ID</td>
          <td>Task</td>
          <td class="text-center">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($todo as $todos)
        <tr>
            <td>{{$todos->id}}</td>
            <td>{{$todos->task}}</td>
            <td class="text-center">
                {{-- todos.edit function call --}}
                <a href="{{ route('todos.edit', $todos->id)}}" class="btn btn-primary btn-sm"">Edit</a>
                {{-- todos.destroy function call --}}
                <form action="{{ route('todos.destroy', $todos->id)}}" method="post" style="display: inline-block">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>

<div class="d-flex justify-content-center">
{{-- todos/create function call --}}

<a href="{{ route('todos.create')}}" class="btn btn-success btn-lg"">Create Task</a>
</div>
@endsection