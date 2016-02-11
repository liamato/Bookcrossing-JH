<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\School;
use App\Report as News;
use App\Book;
use App\Post;
use App\Category;
use App\Video;


class GuestViewsController extends Controller
{
    /**
     * Display the list of available schools
     *
     * @return \Illuminate\Http\Response
     */
    public function schools()
    {
        return view('schools', ['schools' => School::first()? School::all() : []]);
    }

    /**
     * Display the per school home page
     *
     * @return \Illuminate\Http\Response
     */
    public function home(School $school)
    {
        return view('school.home', ['school' => $school]);
    }

    /**
     * Display the per school news page
     *
     * @return \Illuminate\Http\Response
     */
    public function news(School $school)
    {
        return view('school.news', [
            'news' => News::all()->where('school_id', $school->id),
        ]);
    }

    /**
     * Display the per school book list page
     *
     * @return \Illuminate\Http\Response
     */
    public function listing(School $school)
    {
        return view('school.list', [
            'books' => Book::all()->where('school_id', $school->id),
        ]);
    }

    /**
     * Display the per school book capture page
     *
     * @return \Illuminate\Http\Response
     */
    public function capture(School $school)
    {
        return view('school.capture', [
            'books' => Book::all()->where('school_id', $school->id)->where('catched', 0, false),
        ]);
    }

    /**
     * Display the per school book liberate page
     *
     * @return \Illuminate\Http\Response
     */
    public function liberate(School $school)
    {
        return view('school.liberate', [
            'books' => Book::all()->where('school_id', $school->id)->where('catched', 1, false),
        ]);
    }

    /**
     * Display the per school book registration page
     *
     * @return \Illuminate\Http\Response
     */
    public function register(School $school)
    {
        return view('school.register');
    }

    /**
     * Display the per school forum page
     *
     * @return \Illuminate\Http\Response
     */
    public function forum(School $school, $category = null)
    {
        $posts = Post::all()->where('school_id', $school->id);
        if(!is_null($category)){
            $posts = $posts->where('category_id', Category::bySlug($category)->id);
        }
        return view('school.forum', [
            'posts' => $posts,
            'categories' => Category::where('school_id', $school->id)->get(),
            'category' => $category,
        ]);
    }

    /**
     * Display the per school trailer page
     *
     * @return \Illuminate\Http\Response
     */
    public function trailer(School $school, $code = null)
    {
        return view('school.trailer', [
            'trailers' => Video::all()->where('school_id', $school->id)->where('trailer', 1, false),
        ]);
    }

    /**
     * Display the per school tube page
     *
     * @return \Illuminate\Http\Response
     */
    public function tube(School $school, $code = null)
    {
        return view('school.tube', [
            'tubes' => Video::all()->where('school_id', $school->id)->where('tube', 0, false),
        ]);
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
    public function show($id)
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
    public function destroy($id)
    {
        //
    }
}
