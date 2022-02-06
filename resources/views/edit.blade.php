@extends('layout')
@section('content')
<style>
    .container {
      max-width: 450px;
    }
    .push-top {
      margin-top: 50px;
    }
</style>
<div class="card push-top">
  <div class="card-header">
    Edit & Update
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('todos.update', $todo->id) }}">
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="name">Task</label>
              <input type="text" class="form-control" name="name" value="{{ $todo->name }}"/>
          </div>
          <button type="submit" class="btn btn-block btn-primary">Update Task</button>
          <button type="button" class="btn btn-block btn-danger" onclick="window.location='{{ url("/") }}'">Cancel</button>
      </form>
  </div>
</div>
@endsection