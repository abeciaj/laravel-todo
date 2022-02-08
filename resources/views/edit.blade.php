{{-- The edit page --}}

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
    Edit & Update
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

      <form method="post" action="{{ route('todos.update', $todo->id) }}">
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="name">Task</label>
              {{-- Displays the current value of name associated with the $id --}}
              <input type="text" class="form-control" name="name" value="{{ $todo->name }}"/>
          </div>
          <button type="submit" class="btn btn-block btn-primary">Update Task</button>
          {{-- Redirects to / --}}
          <button type="button" class="btn btn-block btn-danger" onclick="window.location='{{ url("/") }}'">Cancel</button>
      </form>
  </div>
</div>
@endsection