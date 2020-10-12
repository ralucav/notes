<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Note::all();
        return view('notes.index', ['notes' => $notes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array('content' => 'required');
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return Redirect::to('notes/create')
                ->withErrors($validator);
        } else {
            $note = new Note();
            $note->content = $request->get('content');
            $note->save();

            Session::flash('message', 'Successfully created note!');
            return Redirect::to('notes');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note = Note::find($id);
        return view('notes.show', ['note' => $note]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $note = Note::find($id);
        return view('notes.edit', ['note' => $note]);
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
        $rules = array('content' => 'required');
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('notes/' . $id . '/edit')
                ->withErrors($validator);
        } else {
            $note = Note::find($id);
            $note->content = $request->get('content');
            $note->save();

            Session::flash('message', 'Successfully updated note!');
            return Redirect::to('notes');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = Note::find($id);
        $note->delete();
        // redirect
        Session::flash('message', 'Successfully deleted the note!');
        return Redirect::to('notes');
    }
}
