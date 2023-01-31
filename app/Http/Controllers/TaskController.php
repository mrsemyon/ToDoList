<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * List of valid task and project statuses.
     *
     * @var array
     */
    private $statuses;

    public function __construct()
    {
        $statuses = DB::table('statuses')->select()->get();
        $this->statuses = $statuses->pluck('name', 'id')->toArray();
    }

    /**
     * List of valid task and project statuses.
     *
     * @var array
     */
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
        $tasks = Task::select('tasks.*', 'users.name as author', 'statuses.name as status', 'statuses.id as status_id')
            ->join('users', 'tasks.user_id', '=', 'users.id')
            ->join('statuses', 'tasks.status', '=', 'statuses.id')
            ->orderBy('tasks.created_at', 'desc')
            ->paginate(4);

        return view('index', ['tasks' => $tasks, 'statuses' => $this->statuses]);
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
            $tasks = Task::select('tasks.*', 'users.name as author', 'statuses.name as status', 'statuses.id as status_id')
                ->join('users', 'tasks.user_id', '=', 'users.id')
                ->join('statuses', 'tasks.status', '=', 'statuses.id')
                ->where('status', '=', $request->input('status'))
                ->orderBy('tasks.created_at', 'desc')
                ->paginate(4);
            return view('search', ['tasks' => $tasks, 'statuses' => $this->statuses]);
        }
        $tasks = Task::select('tasks.*', 'users.name as author', 'statuses.name as status', 'statuses.id as status_id')
            ->join('users', 'tasks.user_id', '=', 'users.id')
            ->join('statuses', 'tasks.status', '=', 'statuses.id')
            ->where('tasks.title', 'like', '%'.$search.'%')
            ->where('status', '=', $request->input('status'))
            ->orWhere('tasks.body', 'like', '%'.$search.'%')
            ->orderBy('tasks.created_at', 'desc')
            ->paginate(4)
            ->appends(['search' => $request->input('search')]);
        return view('search', ['tasks' => $tasks, 'statuses' => $this->statuses]);
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
        return view('show', ['task' => $task, 'statuses' => $this->statuses]);
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
        $task->status = $request->input('status');
        $task->body = $request->input('body');
        $task->save();
        return redirect()->route('index')->with('success', 'Новая задача успешно создана');
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
                ->withErrors('Вы можете редактировать только свои задачи');
        }
        return view('edit', ['task' => $task, 'statuses' => $this->statuses]);
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
                ->withErrors('Вы можете редактировать только свои задачи');
        }
        $task->title = $request->input('title');
        $task->status = ($request->input('status'));
        $task->body = $request->input('body');
        $task->update();
        $tasks = Task::select('tasks.*', 'users.name as author');
        return redirect()
            ->route('index', compact('tasks'))
            ->with('success', 'Задача успешно отредактирована');
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
                ->withErrors('Вы можете удалять только свои задачи');
        }
        $task->delete();
        return redirect()
            ->route('index')
            ->with('success', 'Задача была успешно удалена');
    }
}
