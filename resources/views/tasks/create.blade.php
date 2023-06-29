
@extends('layouts.app')

@section('content')
<h2>Add Task</h2>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
    <div class="card-body">
    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf
        <div class="row mb-3">
            <label for="title">Task Name</label>

            <div class="col-md-6">
            <input type="text" name="title" id="title" required>
        </div>
    </div>
            <div class="row mb-3">
                <label for="details">Task details</label>
                <div class="col-md-6">
            <input type ="text" name="details" id="details" required>
        </div> 
    </div> 

     <div class="row mb-3">
            <label for="finish">Expexted comlition</label>
            <div class="col-md-6">
            <input type="date" name="finish" id="finish"  required>
        </div>
    </div> 
        <button class="button-add"type="submit">Add</button>
        <a class="button-add"  href="{{ route('tasks.index') }}">Cancel</a> <br/>

    </form>
        </div>
    </div>
  </div>
</div>
    @endsection