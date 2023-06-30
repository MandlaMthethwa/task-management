@extends('layouts.app')

@section('content')
<html>
    <body>

        <form action="{{ route('tasks.index') }}" method="GET">
            <a class="button-add"  href="{{ route('tasks.create') }}">Add task</a> <br/>
            <label for="user">Filter by User:</label>
            <select name="user" id="user">
                <option value="">All Users</option>
                @foreach($users->sortBy('name') as $user)
                    @if($user->email !== 'admin@tasks.com')
                        <option value="{{ $user->id }}" {{ $user->id == request('user') ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endif
                @endforeach
            </select>
            <button class="button-add" type="submit">Apply Filter</button>
        </form>
        <table>
            <tr>
                {{-- <th>Number</th> --}}
                <th>Name of Task<a style="text-decoration:none" href="{{ route('tasks.index', ['sort' => 'title']) }}"> sort</a></th>
                <th>Task details<a style="text-decoration:none" href="{{ route('tasks.index', ['sort' => 'details']) }}"> sort</a></th>
                <th>Expected completion date<a style="text-decoration:none" href="{{ route('tasks.index', ['sort' => 'finish']) }}"> sort</a></th>
                 {{-- <th>User</th> --}}
                <th>Progress</th>

                <th>Actions</th>
            </tr>
            @foreach ($tasks as $task)
                <tr>
                    {{-- <td>{{$task->id}} --}}
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->details }}</td>
                    <td>{{ $task->finish }}</td>
                    <td>
                        {{-- @if (Auth::user()->id == $task->user_id) --}}
                        {{-- {{$user->name}}
                        @endif --}}
                    </td>
                    <td>
                        @if ($task->completed)
                        <span style="color: green;">&#10004;</span>
                        @else
                            <form action="{{ route('tasks.complete', $task->id) }}" method="POST" style="display:inline">
                                @csrf
                                <button style="background:rgb(0, 162, 255)" type="submit">Mark as Complete</button>
                            </form>
                        @endif
                        </td>
                        <td>
                              <a class="button-update" href="{{ route('tasks.edit', $task->id) }}">Edit</a> </button>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button class="button-delete"type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
<br>
        {{ $tasks->links() }} <!-- Display pagination links -->
    </body>
</html>
@endsection
