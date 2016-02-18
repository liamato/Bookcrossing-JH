<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RouteOptions as Options;
use App\Book;
use App\School;
use App\Http\Requests\ApiBook;
use App\Http\Controllers\Controller;

class ApiBookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(School $school)
    {
        if ($school->isEmpty()) {
            $book = Book::all();
        } else {
            $book = Book::bySchool($school->id)->get();
        }
        return $book->each(function($book){$book->loads(Options::all());});
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
    public function store(ApiBook $request)
    {
        //$this->validate($re)
        dd($request);
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
            $book = Book::findOrFail($id);
        } else {
            $book = Book::bySchool($school->id)->findOrFail($id);
        }
        return $book->loads(Options::all());
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
