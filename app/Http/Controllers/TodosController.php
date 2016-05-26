<?php

namespace App\Http\Controllers;
use App\Todo;
use Illuminate\Http\Request;

use App\Http\Requests;

class TodosController extends Controller{
	protected $todos;
	public function __construct(Todo $todos){
	
	}
   	public function index(){
   		print json_encode(Todo::all());
   	}
   	public function show($id){
   		print $id;
   		print json_encode(Todo::findOrFail($id));
   	}
}
