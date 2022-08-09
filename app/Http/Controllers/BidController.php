<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bid;
use Illuminate\Support\Facades\File;


class BidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return records
        // get records from dp efficiently 
        $bids = Bid::orderBy('id','desc')->simplePaginate(6);

        return view('home', compact('bids'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Go to create page
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate inputs
        $request->validate([
        'name' => 'required|string',
        'price' => 'required|string',
        'image' => 'required|mimes:jpeg,png|max:2048',
        ]);

        //Post
        $bid = new Bid();

        $bid->name = $request->input('name');
        $bid->price = $request->input('price');
        
        $uploadedFile = $request->file('image');

        //generate new filename using time function since it's random to prevent duplicate image naming
        $filename = time().$uploadedFile->getClientOriginalName();

        //save new filename in db image column
        $bid->image = $filename;

        //move uploaded php temp file to uploads folder with new filename as image name. 
        $uploadedFile->move(public_path('uploads'), $filename);

        $bid->save();

        //redirect page
        return redirect('/home');
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
    public function destroy(Bid $bid)
    {
      //remove file from storage
        if (File::exists(public_path('uploads/'.$bid->image))) {
            File::delete(public_path('uploads/'.$bid->image));
        }
                   
        //delete selected data from db
        $bid->delete();

        return back();
    }
}
