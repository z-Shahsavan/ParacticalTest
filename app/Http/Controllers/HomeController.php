<?php

namespace App\Http\Controllers;

use App\To_dos;
use Illuminate\Http\Request;
use DB;
use Mockery\Exception;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $uid=auth()->user()->id;
        $tds = \DB::table('to_dos')
            ->where('user_id','=', $uid)->orderBy('sort', 'asc')->get();
        return view('home',compact('tds'));
    }

    /**
     * Get a ToDo's id and load its task from DB order by 'sort' field
     * @return array|string
     */
    public function loadTasks()
    {
        $id=$_GET['id'];
        $sort=1;
        $tasks='';
        if(isset($_GET['sort'])){
            $sort=0;
        }
        if($sort==0){
            $tasks=\DB::table('tasks')->where('to_dos_id','=', $id)->orderBy('sort', 'asc')->get();
        }elseif($sort==1){
            $tasks=\DB::table('tasks')->where('to_dos_id','=', $id)->orderBy('sort', 'desc')->get();
        }

        $lis="";
        $tasknum=0;
        if($tasks){
            foreach ($tasks as $ts) {
                $liclass='';
                $imgclass='';
                $imgtags='';
                if($ts->status==0) {
                    $imgtags=" <img title='Cancel this Task' class='cancelicon ' id='canceltask' src='img/cancel.jpg'>
                    <img title='Done this Task' class='donetask' id='donetask' src='img/tick.jpg'>";
                }elseif($ts->status==1){
                    $liclass="class='tddone'";
                }elseif($ts->status==2){
                    $liclass="class='canceled'";
                    //$imgclass="class='disableaction'";
                }
                $tasknum++;
                $lis.="<li id='tsk".$ts->id."' ".$liclass." >
                    <input type='text' class='sorttxt'  value='".$ts->sort."'
                    <strong>".$ts->title."</strong>
                    <strong class='descs'>".$ts->taskdesc."</strong>
                   ".$imgtags."
                   <img title='Delete this Task' class='deltask' id='deltask' src='img/del.png'>
                   </li>";
            }
        }
        $data = array('list' => $lis, 'tasknum' => $tasknum);
        $data = json_encode($data);
        return $data;
    }

    /**
     * Get id of a ToDo list and it's defined 'sort' field and update 'sort' field
     */
    public function updateSortTodo()
    {
        $id=$_GET['id'];
        $val=$_GET['val'];
        DB::table('to_dos')
            ->where('id', $id)
            ->update(['sort' => $val]);
    }

    /**
     * Load a list of sorted ToDo lists.
     * This is run by clicking on 'tick' symbole on top of the Todo's panel
     * @return string
     */
    public function sortTodos()
    {
        $uid=auth()->user()->id;
        $tds = \DB::table('to_dos')
            ->where('user_id','=', $uid)->orderBy('sort', 'asc')->get();
        $lis="";
        if($tds){
            foreach ($tds as $td) {
                $lis.="<li id='todo".$td->id."'  ><input type=\"text\" class=\"sorttxt\"  value='".$td->sort."'";
                $lis.="<strong>".$td->title."</strong><strong class=\"descs\">".$td->text."</strong></li>";
            }
        }
        return $lis;
    }

    /**
     * Define a new ToDO list
     * @param Request $request
     * @return mixed
     */
    public function newTodo(Request $request)
    {
        $title=$request['title'];
        $text=$request['desc'];
        $todo = To_dos::create([
            'title' => $title,
            'text' => $text,
            'status' => 0,
            'sort'=>$request['sort'],
            'user_id'=>auth()->user()->id,
        ]);
        $newid=$todo->id;
        return $newid;
    }

    /**
     * Delete a selected ToDO
     */
    public function deleteTodo()
    {
        $id=$_GET['id'];
        DB::table('to_dos')->where('id',$id)->delete();
    }

    /**
     * Cancel a ToDO of course it's Tasks by set 'status' field value to '2'
     * 2 DB commands along a Transaction
     * @return int
     */
    public function cancelTodo()
    {
        $id=$_GET['id'];
        DB::beginTransaction();
        try {
            DB::table('to_dos')
                ->where('id', $id)
                ->update(['status' => 2]);
            DB::table('tasks')
                ->where('to_dos_id', $id)
                ->update(['status' => 2]);
            DB::commit();
            return 1;
        }catch(Exception $e){
             DB::rollBack();
             return 0;
        }
    }

    /**
     * Cancel a Task by set 'status' field value to '2'
     */
    public function cancelTask()
    {
        $id=$_GET['id'];
        DB::table('tasks')
            ->where('id', $id)
            ->update(['status' => 2]);
    }

    /**
     * Done a ToDO list when one of it's Task is done.
     * By set 'status' fields value to '1'
     * 2 DB commands along a Transaction
     * @return int
     */
    public function doneTask()
    {
        $tdid=$_GET['tdid'];
        $taskid=$_GET['taskid'];
        DB::beginTransaction();
        try {
            DB::table('to_dos')
                ->where('id', $tdid)
                ->update(['status' => 1]);
            DB::table('tasks')
                ->where('id', $taskid)
                ->update(['status' => 1]);
            DB::commit();
            return 1;
        }catch(Exception $e){
            DB::rollBack();
            return 0;
        }
    }

    /**
     * Delete a selected Task
     */
    public function deletetask()
    {
        $id=$_GET['id'];
        DB::table('tasks')->where('id',$id)->delete();
    }

    /**
     * Show a new 'View' (page) to define a new task.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newTask()
    {
        $id=$_GET['id'];
        $title=$_GET['title'];
        $data=array('id'=>$id,'title'=>$title);
        return view('defineTask',compact($data));
    }
}
