<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Models\Task;

class TaskController extends Controller
{
    // public function __construct() {
    //     $this->middleware('auth')->except('index', 'show', 'search', 'active', 'completed');
    // }

    private function checkRights(Task $task) {
        //admin always has id = 1
        return auth()->id() == $task->user_id || auth()->id() == 1;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::select('tasks.*', 'users.name as author', 'statuses.name as status', 'statuses.code as status_code')
            ->join('users', 'tasks.user_id', '=', 'users.id')
            ->join('statuses', 'tasks.status', '=', 'statuses.id')
            ->orderBy('tasks.created_at', 'desc')
            ->paginate(4);
        return view('index', compact('tasks'));
    }

    public function active()
    {
        $tasks = Task::select('tasks.*', 'users.name as author', 'statuses.name as status', 'statuses.code as status_code')
            ->join('users', 'tasks.user_id', '=', 'users.id')
            ->join('statuses', 'tasks.status', '=', 'statuses.id')
            ->orderBy('tasks.created_at', 'desc')
            ->where('statuses.code', '!=', 'done')
            ->paginate(4);
        return view('active', compact('tasks'));
    }

    public function completed()
    {
        $tasks = Task::select('tasks.*', 'users.name as author', 'statuses.name as status', 'statuses.code as status_code')
            ->join('users', 'tasks.user_id', '=', 'users.id')
            ->join('statuses', 'tasks.status', '=', 'statuses.id')
            ->orderBy('tasks.created_at', 'desc')
            ->where('statuses.code', '=', 'done')
            ->paginate(4);
        return view('completed', compact('tasks'));
    }

    /**
     * Show the form for searching a existing resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $search = $request->input('search', '');
        $search = iconv_substr($search, 0, 64);
        $search = preg_replace('#[^0-9a-zA-ZА-Яа-яёЁ]#u', ' ', $search);
        $search = preg_replace('#\s+#u', ' ', $search);
        if (empty($search)) {
            return view('search');
        }
        $tasks = Task::select('tasks.*', 'users.name as author')
            ->join('users', 'tasks.user_id', '=', 'users.id')
            ->where('tasks.title', 'like', '%'.$search.'%')
            ->orWhere('tasks.body', 'like', '%'.$search.'%')
            //->orWhere('tasks.name', 'like', '%'.$search.'%')
            ->orderBy('tasks.created_at', 'desc')
            ->paginate(4)
            ->appends(['search' => $request->input('search')]);;
        return view('search', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        $task = new Task();
        $task->user_id = auth()->id();
        $task->title = $request->input('title');
        $task->done = ($request->input('done'))?'1':'0';
        $task->body = $request->input('body');
        $task->save();
        return redirect()->route('index')->with('success', 'Новый пост успешно создан');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::select('tasks.*', 'users.name as author', 'statuses.name as status', 'statuses.code as status_code')
            ->join('users', 'tasks.user_id', '=', 'users.id')
            ->join('statuses', 'tasks.status', '=', 'statuses.id')
            ->find($id);
        return view('show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        if (!$this->checkRights($task)) {
            return redirect()
                ->route('index')
                ->withErrors('Вы можете редактировать только свои посты');
        }
        return view('edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, $id)
    {
        $task = Task::find($id);
        if (!$this->checkRights($task)) {
            return redirect()
                ->route('index')
                ->withErrors('Вы можете редактировать только свои посты');
        }
        $task->title = $request->input('title');
        $task->done = ($request->input('done'))?'1':'0';
        $task->body = $request->input('body');
        $task->update();
        $tasks = Task::select('tasks.*', 'users.name as author');
        return redirect()
            ->route('index', compact('tasks'))
            ->with('success', 'Пост успешно отредактирован');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        if (!$this->checkRights($task)) {
            return redirect()
                ->route('index')
                ->withErrors('Вы можете редактировать только свои посты');
        }
        $task->delete();
        return redirect()
            ->route('index')
            ->with('success', 'Пост был успешно удален');
    }
}
