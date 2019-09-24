<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Group;
use App\Http\Resources\GroupResource;
use App\Services\Gitlab;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Gitlab $gitlab)
    {
        //Fetch groups from gitlab first later use cache to do this only once a day
        //Maybe feature flag this
        $gitlab->getGroups();
        //Get groups
        $groups = Group::all();
        return response()->json($groups);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedRequest = request()->validate([
            'name' => ['required', 'min:3'],
            'description' => ['required', 'min:10']
        ]);
        return response()->json(Group::create($validatedRequest));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        $groupResource = new GroupResource($group);
        return response()->json($groupResource);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        $validatedRequest = request()->validate([
            'name' => ['min:3'],
            'description' => ['min:10']
        ]);
        $group->update($validatedRequest);
        return response()->json($group);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        return response()->json($group->delete());
    }
}
