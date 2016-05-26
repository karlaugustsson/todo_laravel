@extends('layouts/master')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New Task Form -->
        <form action="{{ url('todo') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- Task Name -->
            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">Todo</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="todo-name" class="form-control">
                </div>
            </div>

            <!-- Add Task Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add Todo
                    </button>
                </div>
            </div>
        </form>
    </div>

    @if(count($todos) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Todo
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>Todo</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        @foreach ($todos as $todo)
                            <tr>
                                <!-- Task Name -->
                                <td class="table-text">
                                    <div>{{ $todo->name }}</div>
                                </td>

                                <td>
                                    <form action="{{ url('todo/'.$todo->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                        <button type="submit" class="btn btn-danger">
                                         <i class="fa fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection