<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Programme;
use Facades\App\Helpers\Json;
use Illuminate\Http\Request;

class ProgrammeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programmes = Programme::orderBy('name')
            ->with("courses")
            ->get();
        $result = compact('programmes');
        Json::dump($result);
        return view("admin.programmes.index", $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.programmes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate $request
        $this->validate($request,[
            'name' => 'required|min:3|unique:programmes,name'
        ]);

        // Create new genre
        $programme = new Programme();
        $programme->name = $request->name;
        $programme->save();

        // Flash a success message to the session
        session()->flash('success', "The programme <b>$programme->name</b> has been added");
        // Redirect to the master page
        return redirect('admin/programmes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Programme  $programmes
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $programmes = Programme::with('courses')
            ->findOrFail($id)
            ->makeHidden(["created_at", "updated_at"]);
        $result = compact( "programmes");           // compact('records') is the same as ['records' => $records]
        Json::dump($result);                        // open http://vinyl_shop.test/shop?json
        return view('admin.programmes.show', $result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Programme  $programmes
     * @return \Illuminate\Http\Response
     */
    public function edit(Programme $programmes)
    {
        $result = compact('programmes');
        Json::dump($result);
        return view("admin.programmes.edit", $result);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Programme  $programmes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Programme $programmes)
    {
        // Validate $request
        $this->validate($request,[
            'name' => 'required|min:3|unique:programmes,name,' . $programmes->id
        ]);

        // Update programme
        $programmes->name = $request->name;
        $programmes->save();

        // Flash a success message to the session
        session()->flash('success', 'The programme has been updated');
        // Redirect to the master page
        return redirect('admin/programmes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Programme  $programmes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Programme $programmes)
    {
        $programmes->delete();
        session()->flash('success', "The genre <b>$programmes->name</b> has been deleted");
        return redirect('admin/programmes');
    }
}
