<?php

namespace App\Http\Controllers;

use App\Repositories\TaskRepository;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController extends Controller
{
	/**
	 * Экземпляр TaskRepository.
	 *
	 * @var TaskRepository
	 */
	protected $tasks;

	/**
	 * Делаем проверку что пользователь авторизированный  через посредник.
	 *
	 * @param  TaskRepository $tasks
	 * @return void
	 * */
	public function __construct (TaskRepository $tasks)
	{
		$this->middleware('auth');
		$this->tasks = $tasks;
	}

	/**
	 * Отображение списка всех задач пользователя.
	 *
	 * @param Request $request
	 * @return Response
	 * */
	public function index (Request $request)
	{
		$tasks = $request->user()->tasks()->get();

		//для версии 5.1
		//$tasks = Task::where('user_id', $request->user()->id)->get();

		return view('tasks.index',
			[
				'tasks' => $this->tasks->forUser($request->user()),
			]);
	}

	/**
	 * Создание новой задачи.
	 *
	 * @param  Request $request
	 * @return Response
	 */
	public function store (Request $request)
	{
		$this->validate($request,
			[
				'name' => 'required|max:255',
			]);

		$request->user()->tasks()->create([
			'name' => $request->name,
		]);

		return redirect('/tasks');
	}

	/**
	 * Уничтожить заданную задачу.
	 *
	 * @param Request $request
	 * @param Task $task
	 *
	 * @return Response
	 * */
	public function destroy (Request $request, Task $task)
	{
		$this->authorize('destroy', $task);

		$task->delete();

		return redirect('/tasks');
	}
}
