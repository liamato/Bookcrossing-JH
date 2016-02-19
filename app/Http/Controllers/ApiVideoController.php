<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RouteOptions as Options;
use App\Video;
use App\School;
use App\Http\Requests\ApiVideo;
use App\Http\Controllers\Controller;

class ApiVideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'store']]);
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
    public function store(ApiVideo $request, School $school)
    {
        $insert = $request->json()->all();
        if (!isset($insert['school_id']) && $school->filledOrFail()) {
            $insert['school_id'] = $school->id;
        }
        return Video::create($insert);
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
