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
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
      </ul>
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
      @foreach($todos as $todo)
      
        <tr>
          <td>{{ $todo->id }}</td>
          <td>{{ $todo->name }}</td>
          <td class="text-center">
            {{-- todos.edit function call --}}
            {{-- <a href="{{ route('todos.edit', $todos->id)}}" class="btn btn-primary btn-sm"">Edit</a> --}}
            {{-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#updateModal-{{ $todo->id }}">
              Edit
            </button> --}}
            <a class="btn btn-primary btn-sm update-button" role="button" data-task-update="{{ route('todos.update', $todo->id) }}" data-toggle="modal" data-target="#update-modal">Delete</a>
            {{-- todos.destroy function call --}}
            <form action="{{ route('todos.destroy', $todo->id) }}" method="post" style="display: inline-block">
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
  <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#createModalCenter">
    Create Task
  </button>
</div>

<!-- Create Button trigger modal -->


<!-- Create Modal -->
<div class="modal fade" id="createModalCenter" tabindex="-1" role="dialog" aria-labelledby="createModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createModalLongTitle">Create Task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form method="post" action="{{ route('todos.store') }}">
        <div class="modal-body">
          <div class="form-group">
            @csrf
            <label for="name">Task</label>
            <input type="text" class="form-control" name="name"/>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Create Task</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Update Modal -->
<div class="modal fade" id="update-modal" tabindex="-1" role="dialog" aria-labelledby="updateModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateModalLongTitle">Update Task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form method="post" id ="update-form" action="">
        <div class="modal-body">
          <div class="form-group">
            @csrf
            @method('PATCH')
            <h3>{{ $todo->id }}</h3>
            <label for="name">Task</label>
            {{-- Displays the current value of name associated with the $id --}}
            <input type="text" class="form-control" id="name" name="name" value="{{ $todo->name }}"/>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update Task</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script>
  $('.update-button').on('click', function () {
    $('#update-form').attr('action', $(this).data('task-update'));
});
</script>

@endsection