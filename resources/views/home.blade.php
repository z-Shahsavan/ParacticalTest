@extends('layouts.app')
@section('style')
    .panelcolor{background-color:#c4e3f3;}
    .tdlist{list-style-type: none;text-align: left;margin-left: -40px;cursor: pointer;}
    .tddone{color: darkgreen;background-color: #c4fff3}
    .descs{padding-left: 50px}
    span.sorttxt{padding:10px 10px 10px 0px}
    input.sorttxt{margin-right: 30px}
    .tickicon{height: 20px;width:20px;margin-right:130px;cursor: pointer;}
    .plusicon{height: 20px;width:20px;margin-left:300px;cursor: pointer;}
    .delicon, .cancelicon, .donetask, .deltask, .newtaskicon {height: 30px;width:30px;cursor: pointer;}
    .sortt2d, .sortd2t {height: 10px;width:10px;cursor: pointer;}
    .canceled{color:red}
    .tsklist li{list-style-type: none;}
    .disableaction{cursor:no-drop}
@endsection
@section('script')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script>
        $(function(){
            $('.tdlist').on('click', 'li', function() {
                $('#delicon').addClass('hidden');
                $('#cancelicon').removeClass('hidden');
                $('#newtaskicon').removeClass('hidden');
                var id=$(this).attr('id');
                id=id.substr(4);
                $('#thistodo').find('#selectedtodo').text($(this).find('#todotitle').text());
                $.ajax({
                    url: '/loadTasks/',
                    type: 'GET',
                    data: { id: id },
                    dataType: 'json',
                    success: function(response)
                    {
                        $('#selectedid').val(id);
                        if(response.tasknum==0) {
                            $('#delicon').removeClass('hidden');
                        }
                        $('#taskslist').html(response.list);
                    }
                });
            });
            var changeTDSort=0;
            $('.sorttxt').on('change',function(){
                var val=$(this).val();
                var id=$(this).closest('li').attr('id').substr(4);
                changeTDSort=1;
                $.ajax({
                    url: '/updateSortTodo',
                    type: 'GET',
                    data: { id: id ,val:val},
                });
            });
            $('.tickicon').on('click',function(){
                if(changeTDSort!=0){
                    changeTDSort=0;
                    $.ajax({
                        url: '/sortTodos',
                        type: 'GET',
                        success: function(response)
                        {
                            $('#tdlist').html(response);
                        }
                    });
                }
            });
            $('#cancelicon').on('click',function(){
                var id=$('#selectedid').val();
                var r = confirm("Are you sure to cancel this ToDo list?");
                if (r == true) {
                    $.ajax({
                        url: '/cancelTodo',
                        type: 'GET',
                        data: {id : id} ,
                        success: function(response)
                        {
                            var li=$('#todo'+id);
                            if(response==1) {
                                li.addClass('canceled');
                                $('#taskslist li').each(function(){
                                    $(this).addClass('canceled');
                                });
                            }
                        }
                    });
                }
            });
            $('#delicon').on('click',function(){
                var id=$('#selectedid').val();
                var r = confirm("Are you sure to delete this ToDo list?");
                if (r == true) {
                    $.ajax({
                        url: '/deleteTodo',
                        type: 'GET',
                        data: {id : id} ,
                        success: function(response)
                        {
                            $('#thistodo').html("");
                            var li=$('#todo'+id);
                            li.remove();
                        }
                    });
                }
            });
            $('#taskslist').on('click','#deltask',function(){
                var thisrow=$(this).closest('li');
                var taskid = thisrow.attr('id').substr(3);
                var r = confirm("Are you sure to cancel this Task?");
                if (r == true) {
                    $.ajax({
                        url: '/deletetask',
                        type: 'GET',
                        data: {id: taskid},
                        success: function (response) {
                            thisrow.remove();
                        }
                    });
                }
            });
            $('#taskslist').on('click','#canceltask',function(){
                if(!$(this).hasClass('disableaction')) {
                    var thisrow=$(this).closest('li');
                    var imgcancel=$('#taskslist').find(thisrow).find('#canceltask');
                    var imgdone=$('#taskslist').find(thisrow).find('#donetask');
                    var id = thisrow.attr('id').substr(3);
                    var r = confirm("Are you sure to cancel this Task?");
                    if (r == true) {
                        $.ajax({
                            url: '/cancelTask',
                            type: 'GET',
                            data: {id: id},
                            success: function (response) {
                                thisrow.addClass('canceled');
                                imgcancel.remove();
                                imgdone.remove();
                            }
                        });
                    }
                }
            });
            $('#taskslist').on('click','#donetask',function(){
                var thisrow=$(this).closest('li');
                var imgcancel=$('#taskslist').find(thisrow).find('#canceltask');
                var imgdone=$('#taskslist').find(thisrow).find('#donetask');
                var taskid = thisrow.attr('id').substr(3);
                var todorow=$('#todo'+$('#selectedid').val());
                var r = confirm("Are you sure to done this Task?");
                if (r == true) {
                    $.ajax({
                        url: '/doneTask',
                        type: 'GET',
                        data: {taskid: taskid,tdid:$('#selectedid').val()},
                        success: function (response) {
                            thisrow.addClass('tddone');
                            imgcancel.remove();
                            imgdone.remove();
                            todorow.addClass('tddone');
                            todorow.removeClass('canceled');
                        }
                    });
                }
            });
            $('#newtaskicon').on('click',function(){
                $.ajax({
                    url: '/newTask',
                    type: 'GET',
                    data: {id: 1, title: "AAA"},
                    success: function (response) {
                    }
                });
            });
            $('#sortd2t').on('click',function(){
                $.ajax({
                    url: '/loadTasks/',
                    type: 'GET',
                    data: { id: $('#selectedid').val(),sort:1 },
                    dataType: 'json',
                    success: function(response)
                    {
                        $('#sortd2t').addClass('hidden');
                        $('#sortt2d').removeClass('hidden');
                        $('#taskslist').html(response.list);
                    }
                });
            });
            $('#sortt2d').on('click',function(){
                $.ajax({
                    url: '/loadTasks/',
                    type: 'GET',
                    data: { id: $('#selectedid').val(),sort:0 },
                    dataType: 'json',
                    success: function(response)
                    {
                        $('#sortd2t').removeClass('hidden');
                        $('#sortt2d').addClass('hidden');
                        $('#taskslist').html(response.list);
                    }
                });
            });
        });

    </script>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" >
                        <span class="sorttxt">Sort</span>
                        <img class="tickicon" id="tickicon" src="{{asset('img/tick.jpg')}}">
                        <strong>Title</strong><strong  class="descs">Description</strong>
                        <a href="{{ route('idx')}}/createnew"><img class="plusicon" id="plusicon" src="{{asset('img/plus.jpg')}}"></a>
                    </div>
                    <div class="panel-body panelcolor" >
                        <ul class="tdlist" id="tdlist">
                            @foreach($tds as $td)
                                <?php  $state=""; ?>
                                @if($td->status==1)
                                        <?php $state="tddone" ?>
                                @elseif($td->status==2)
                                        <?php $state="canceled" ?>
                                @endif
                                 <li class="{{$state}}" id="todo{{$td->id}}" >
                                     <input type="text" class="sorttxt"  value="{{$td->sort}}">
                                     <strong id="todotitle">{{$td->title}}</strong>
                                     <strong class="descs">{{$td->text}}</strong>
                                 </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        {{--task section--}}
        <div class="row">
            <div class="row" id="thistodo" >
                <label id="selectedtodo"></label>
                <img title="Cancel this ToDo" class="cancelicon hidden" id="cancelicon" src="{{asset('img/cancel.jpg')}}">
                <img title="Delete this ToDo" class="delicon hidden" id="delicon" src="{{asset('img/del.png')}}">
                <img title="Define new Task" class="newtaskicon hidden" id="newtaskicon" src="{{asset('img/plus.jpg')}}">
                <input type="hidden" id="selectedid">
            </div>
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="sorttxt">Sort</span>
                        <img class="sortt2d hidden" id="sortt2d" src="{{asset('img/top.png')}}">
                        <img class="sortd2t " id="sortd2t" src="{{asset('img/down.png')}}">
                        <strong>Title</strong><strong  class="descs">Description</strong>
                    </div>
                    <div class="panel-body">
                        <ul class="tsklist" id="taskslist">
{{--tasks of selected ToDo--}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
