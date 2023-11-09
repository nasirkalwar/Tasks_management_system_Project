<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Other meta tags and CSS links -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css')}}">

</head>

<body>
        
            <header>
                    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
                <!-- Brand -->
                <div class="container">
                <a class="navbar-brand" href="{{ url('/tasks')}}">Nasir Ali</a>

                <!-- Links -->
                    <ul class="navbar-nav">
                    @if(Route::has('login'))

                    @auth
                    <li class="scroll-to-section">
                        <x-app-layout> </x-app-layout>
                    </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                    @endif
                    
                    </ul>
                    </div>

                </nav>
            </header>

    <!-- Your content here -->
    <br>
    <br>
    <div class="container text-center">
        <h1>Task Management System</h1>

        <h2>Task List</h2> @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <!-- Rest of your content -->
    </div>

    <div class="container">
        <form action="{{ route('filter')}}" method="get">
            <div class="input-group">
            <select class="form-select" name="filter_status">
                <option value="">All Tasks</option>
                <option value="complated">Complated</option>
                <option value="uncomplated">Uncomplated</option>
            </select>
            <button type="submit" class="btn btn-primary">Task Status Filter</button>
            </div>
        </form>
    <div style="text-align:right;">
        <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Create Task</a>
        <a href="{{ route('taskshow') }}" class="btn btn-secondary mb-3">Show Completed Tasks</a>
    </div>
    
    
  
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Priority</th>
                    <th>Due Date</th>
                    <th>Actions</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->priority }}</td>
                    <td>{{ $task->due_date }}</td>
                    <td>
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this task?')">
                                <i class="fa fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                    <td>
                            @if($task->status=='uncomplete')
                        <form action="{{ route('tasks.complate', $task->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-warning btn-sm">
                                <i class="fa fa-check"></i> Complete
                            </button>
                            
                        </form>
                        @else
                            <p Style="color:blue;">Task Completed</p>
                        @endif
                    </td>



                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 
</body>

</html>