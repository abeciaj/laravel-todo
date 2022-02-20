{{-- The create page --}}

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

{{-- Card --}}

<div class="card push-top">
  <div class="card-header">
    Add Task
  </div>
  <div class="card-body">

    {{-- Alert when returning an error --}}

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif

      {{-- Update Form --}}
    
      <form method="post" action="{{ route('todos.store') }}">
          <div class="form-group">
              @csrf
              <label for="task">Task</label>
              <input type="text" class="form-control" name="task"/>
          </div>
          <button type="submit" class="btn btn-block btn-primary">Create Task</button>
          {{-- Redirects to / --}}
          <button type="button" class="btn btn-block btn-danger" onclick="window.location='{{ url("/") }}'">Cancel</button>
      </form>
  </div>
</div>
@endsection