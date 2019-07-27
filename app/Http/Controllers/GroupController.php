<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
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
    public function index()
    {
        $groups = Group::all();
        return view('groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ////////////////////
        // First approach //
        ////////////////////
        // $group = new Group();
        // $group->name = request('name');
        // $group->description = request('description');
        // $group->save();

        ////////////////////
        //Second approach //
        ////////////////////
        // group::create([
        //     'name' => request('name'),
        //     'description' => request('description')
        // ]);

        ///////////////////
        //Third approach //
        ///////////////////
        // group::create(request(['name', 'description']));
        // return redirect('/groups');

        ////////////////////
        //With validation //
        ////////////////////
        $validatedRequest = request()->validate([
            'name' => ['required', 'min:3'],
            'description' => ['required', 'min:10']
        ]);
        Group::create($validatedRequest);
        return redirect('/groups');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        //Done in view groups.show
        // $tasks = $group->tasks;
        // dd($tasks);
        return view('groups.show', compact('group'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        return view('groups.edit', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        ///////////////////
        //First approach //
        ///////////////////
        // $group->name = request('name');
        // $group->description = request('description');
        // $group->save();
        $validatedRequest = request()->validate([
            'name' => ['required', 'min:3'],
            'description' => ['required', 'min:10']
        ]);
        $group->update($validatedRequest);
        return redirect('/groups');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        $group->delete();
        return redirect("/groups");
    }
}
