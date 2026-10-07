<?php
use Illuminate\Support\Facades\Route;
Route::get('/',fn()=>response()->json(['name'=>'Bankey Web API','status'=>'ok']));
