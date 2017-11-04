@extends('layouts.app')
@section('style')

@endsection
@section('script')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script>
        $(function(){

        });
    </script>
@endsection
@section('content')
    {{ Request::route('id') }}
    <div class="container">
            <div class="col-md-8 col-md-offset-2">
                {{--<form >--}}
                    {{--ction="/newTodo" method="post">--}}
                    {{ csrf_field() }}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>ToDo</strong>
                    </div>
                    <div class="panel-body">
                            <div class="row"></div>
                    </div>
                </div>
            </div>
        {{--tasks section--}}
        <div class="col-md-8 col-md-offset-2">
                {{ csrf_field() }}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Define ToDo Tasks</strong>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="form-group">
                                <label for="tasktitle" class="col-md-4 control-label">Title</label>
                                <div class="col-md-6">
                                    <input id="tasktitle" type="text" class="form-control" name="tasktitle" value="{{ old('tasktitle') }}"  required autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="taskdesc" class="col-md-4 control-label">Description</label>
                                <div class="col-md-6">
                                    <input id="taskdesc" type="text" class="form-control" name="taskdesc" value="{{ old('taskdesc') }}" required autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 ">
                                <button type="submit" class="btn btn-success" id="newtaskbtn">
                                    Define Task
                                </button>
                            </div>
                            <div class="col-md-8 ">
                                <label id="msgtask"  class="hidden control-label">Task defineded successfully!</label>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection
