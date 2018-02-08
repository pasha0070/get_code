<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController extends Controller
{
	/**
	 * Делаем проверку что пользователь авторизированный  через посредник.
	 * */
	public function __construct ()
	{
		$this->middleware('auth');
	}

	/**
	 * Отображение списка всех задач пользователя.
	 *
	 * @param Request $request
	 * @return Response
	 * */
	public function index (Request $request)
	{
		return view('tasks.index');
	}
}
