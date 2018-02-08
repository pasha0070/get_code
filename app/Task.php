<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
	/**
	 * Массово присваиваемые атрибуты.
	 *
	 * @var array
	 * */
    protected $fillable = ['name'];

    /**
	 * Получения владельца задачи в соотношение 1 к 1
     * */
    public function user(){
    	return $this->belongsTo(User::class);
	}
}
