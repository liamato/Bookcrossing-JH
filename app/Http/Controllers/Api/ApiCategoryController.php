<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use RouteOptions as Options;
use App\Category;
use App\School;
use App\Http\Requests\ApiCategory;
use App\Http\Requests\ApiCategoryUpdate;
use App\Http\Controllers\Controller;

class ApiCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show']]);
        $this->middleware('csrf', ['except' => ['index','show']]);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApiCategory $request, School $school)
    {
        $insert = $request->json()->all();
        if (!isset($insert['school_id']) && $school->filledOrFail()) {
            $insert['school_id'] = $school->id;
        }
        $c = Category::create($insert);
        return Category::findOrFail($c->id);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ApiCategoryUpdate $request, School $school, $id)
    {
        if (!$school->isEmpty()) {
            $item = Category::bySchool($school->id)->findOrFail($id);
        } else {
            $item = Category::findOrFail($id);
        }

        $all = $request->json()->all();
        $attrs = $item->filterColumns(array_keys($all));

        if (isset($all['id'])) {
            unset($all['id']);
        }

        if (isset($all['school_id'])) {
            unset($all['school_id']);
        }

        foreach ($all as $key => $value) {
            if (in_array($key, $attrs)) {
                $item->$key = $value;
            }
        }

        $item->save();

        return $item;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school, $id)
    {
        if ($school->isEmpty()) {
            $category = Category::findOrFail($id);
        } else {
            $category = Category::bySchool($school->id)->findOrFail($id);
        }
        $category->delete();
    }
}
