<?php

// https://leafphp.dev/docs/mvc/controllers.html#resource-controllers

namespace App\Controllers;

use App\Models\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        |
        | This is an example which retrieves all the data (rows)
        | from our model. You can un-comment it to use this
        | example
        |
        */
        // response()->json(User::all());
        response()->json('Hello World!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        /*
        |--------------------------------------------------------------------------
        |
        | This is an example which deletes a particular row.
        | You can un-comment it to use this example
        |
        */
        // $row = new User;
        // $row->column = request()->get('column');
        // $row->delete();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        response()->json('Hello World!' . $id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        /*
        |--------------------------------------------------------------------------
        |
        | This is an example which edits a particular row.
        | You can un-comment it to use this example
        |
        */
        // $row = User::find($id);
        // $row->column = request()->get('column');
        // $row->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        /*
        |--------------------------------------------------------------------------
        |
        | This is an example which deletes a particular row.
        | You can un-comment it to use this example
        |
        */
        // $row = User::find($id);
        // $row->delete();
    }
}
