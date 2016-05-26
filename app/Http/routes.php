<?php
use App\Todo;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get("/" , function(Request $request){

	$todos = Todo::orderBy("created_at" , "asc")->get();

	return view('todos',['todos' => $todos]);
});

Route::post("/todo",function(Request $request){
$validator = Validator::make($request->all(),
	['name' => 'required|max:225']
	);

	if ($validator->fails()){
		return redirect("/")->withInput()->withErrors($validator);
	}
	$todo = new Todo;
	$todo->name = $request->name;
	$todo->save();

	return redirect("/");
});

Route::delete('/todo/{todo}', function (Todo $todo) {

    $todo->delete();

    return redirect('/');
});

