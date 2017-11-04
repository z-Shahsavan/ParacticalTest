@extends('layouts.app')
@section('style')

@endsection
@section('script')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script>
        $(function(){
            $('#newtodobtn').on('click',function(){
                var _token = $("input[name='_token']").val();
                $.ajax({
                    url: '/newTodo/',
                    type: 'POST',
                    data: {_token:_token, 'title': $('#title').val(), 'desc': $('#desc').val(),'sort': $('#sort').val() },
                    success: function(response)
                    {
                        $('#todoid').val(response);
                        $('#msglable').removeClass('hidden');
                    }
                });
            });
        });
    </script>
@endsection
@section('content')
    <div class="container">
            <div class="col-md-8 col-md-offset-2">
                {{--<form >--}}
                    {{--ction="/newTodo" method="post">--}}
                    {{ csrf_field() }}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>New ToDo</strong>
                    </div>
                    <div class="panel-body">
                            <div class="row">
                                <input type="hidden" id="todoid" name="todoid">
                            <div class="form-group">
                                <label for="title" class="col-md-4 control-label">Title</label>
                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}"  required autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="desc" class="col-md-4 control-label">Description</label>
                                <div class="col-md-6">
                                    <input id="desc" type="text" class="form-control" name="desc" value="{{ old('desc') }}" required autofocus>
                                </div>
                            </div>
                           <div class="form-group">
                                <label for="sort" class="col-md-4 control-label">Sort</label>
                                <div class="col-md-6">
                                    <input id="sort" type="number" class="form-control" name="sort" value="{{ old('sort') }}" required autofocus>
                                </div>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 ">
                                     <button  class="btn btn-success" id="newtodobtn">
                                    Create ToDo
                                     </button>
                                </div>
                                <div class="col-md-8 ">
                                    <label id="msglable"  class="hidden control-label">ToDo list created successfully!</label>
                                </div>
                            </div>
                    </div>
                </div>
                {{--</form>--}}
            </div>
    </div>
@endsection
