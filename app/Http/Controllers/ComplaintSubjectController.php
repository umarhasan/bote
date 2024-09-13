<?php

namespace App\Http\Controllers;


class ComplaintSubjectController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('complaint_subject.index');
    }
    public function edit($type,$id)
    {
        return view('complaint_subject.edit')->with('type', $type)->with('id', $id);
    }

    public function create()
    {
        return view('complaint_subject.create');
    }

}