<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RouteOptions as Options;
use App\School;
use App\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ApiCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(School $school)
    {
        if ($school->isEmpty()) {
            $category = Category::all();
        } else {
            $category = Category::bySchool($school->id)->get();
        }
        return $category->each(function($category){$category->loads(Options::all());});
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(School $school, $id)
    {
        if ($school->isEmpty()) {
            $category = Category::findOrFail($id);
        } else {
            $category = Category::bySchool($school->id)->findOrFail($id);
        }
        return $category->loads(Options::all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
