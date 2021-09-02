<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListModel;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = ListModel::paginate();

        return response()->json([
            'lists' => $lists,
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request);

        $list = new ListModel();
        $list->name = $request->name;
        $list->description = $request->description;
        $list->save();

        return response()->json([
            'msg' => 'list has been created!',
            'list' => $list,
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $list = ListModel::findOrFail($id);

        return response()->json([
            'list' => $list,
        ],200);
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
        $this->validator($request);

        $list = ListModel::findOrFail($id);
        $list->name = $request->name;
        $list->description = $request->description;
        // $list->status = $request->status;
        $list->save();

        return response()->json([
            'msg' => 'list has been updated!',
            'list' => $list,
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $list = ListModel::findOrFail($id);

        $list->delete();

        return response()->json([
            'msg' => 'list has been deleted!',
            'list' => $list,
        ],200);
    }

    /**
     * Validate the Request.
     * @param Request $request
     * @return void
     */
    private function validator(Request $request){
        $this->validate($request,[
            'name' => 'required|string|min:5|max:191',
            'description' => 'required|string|min:5|max:5000',
        ]);
    }
}
