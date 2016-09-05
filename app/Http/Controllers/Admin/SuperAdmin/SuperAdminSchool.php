<?php

namespace App\Http\Controllers\Admin\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Requests\AdminAddSchool;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\School;
use App\Category;

class SuperAdminSchool extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('admin.school.add', ['users' => User::all('email')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminAddSchool $request)
    {
        $r = $request->json()->all();
        $school = School::create(['name' => $r['name'], 'slug' => $r['slug']]);
        $user = User::create(['name' => $r['uname'], 'email' => $r['umail'], 'password' => bcrypt($r['upassword']), 'school_id' => $school->id]);
        $cat = Category::create(['name' => $r['cname'], 'slug' => $r['cslug'], 'school_id' => $school->id]);
        return ['school' => $school, 'user' => $user, 'category' => $cat];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function dump($id)
    {
        //
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
    public function remove($id)
    {
        //
    }
}
