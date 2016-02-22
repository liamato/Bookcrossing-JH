<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RouteOptions as Options;
use App\User;
use App\School;
use App\Http\Requests\ApiUser;
use App\Http\Requests\ApiUserUpdate;
use App\Http\Controllers\Controller;

class ApiUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(School $school)
    {
        if ($school->isEmpty()) {
            $user = User::all();
        } else {
            $user = User::bySchool($school->id)->get();
        }
        return $user->each(function($user){$user->loads(Options::all());});
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
    public function store(ApiUser $request, School $school)
    {
        $insert = $request->json()->all();
        if (!isset($insert['school_id']) && $school->filledOrFail()) {
            $insert['school_id'] = $school->id;
        }
        return User::create($insert);
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
            $user = User::findOrFail($id);
        } else {
            $user = User::bySchool($school->id)->findOrFail($id);
        }
        return $user->loads(Options::all());
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
    public function update(ApiUserUpdate $request, School $school, $id)
    {
        if (!$school->isEmpty()) {
            $item = User::bySchool($school->id)->findOrFail($id);
        } else {
            $item = User::findOrFail($id);
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
            $user = User::findOrFail($id);
        } else {
            $user = User::bySchool($school->id)->findOrFail($id);
        }
        $user->delete();
    }
}
