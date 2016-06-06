<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use RouteOptions as Options;
use App\Video;
use App\School;
use App\Http\Requests\ApiVideo;
use App\Http\Requests\ApiVideoUpdate;
use App\Http\Controllers\Controller;

class ApiVideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'store']]);
        $this->middleware('csrf', ['except' => ['index', 'show', 'store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(School $school)
    {
        if ($school->isEmpty()) {
            $video = Video::all();
        } else {
            $video = Video::bySchool($school->id)->get();
        }
        return $video->each(function($video){$video->loads(Options::all());});
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApiVideo $request, School $school)
    {
        $insert = $request->json()->all();
        if (!isset($insert['school_id']) && $school->filledOrFail()) {
            $insert['school_id'] = $school->id;
        }
        $v = Video::create($insert);
        return Video::findOrFail($v->id);
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
            $video = Video::findOrFail($id);
        } else {
            $video = Video::bySchool($school->id)->findOrFail($id);
        }
        return $video->loads(Options::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ApiVideoUpdate $request, School $school, $id)
    {
        if (!$school->isEmpty()) {
            $item = Video::bySchool($school->id)->findOrFail($id);
        } else {
            $item = Video::findOrFail($id);
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
            $video = Video::findOrFail($id);
        } else {
            $video = Video::bySchool($school->id)->findOrFail($id);
        }
        $video->delete();
    }
}
