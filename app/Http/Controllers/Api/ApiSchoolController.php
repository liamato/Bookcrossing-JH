<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use RouteOptions as Options;
use App\School;
use App\Http\Requests\ApiSchool;
use App\Http\Requests\ApiSchoolUpdate;
use App\Http\Controllers\Controller;

class ApiSchoolController extends Controller
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
    public function index()
    {
        return School::all()->each(function($school){$school->loads(Options::all());});
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApiSchool $request)
    {
        $s = School::create($request->json()->all());
        return School::findOrFail($s->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (is_numeric($id)) {
            return School::findOrFail($id)->loads(Options::all());
        }
        return School::bySlug($id)->loads(Options::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ApiSchoolUpdate $request, $id)
    {
        $item = School::findOrFail($id);
        $all = $request->json()->all();
        $attrs = $item->filterColumns(array_keys($all));

        if (isset($all['id'])) {
            unset($all['id']);
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
    public function destroy($id)
    {
        School::findOrFail($id)->delete();
    }
}
