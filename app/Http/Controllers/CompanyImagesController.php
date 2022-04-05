<?php

namespace App\Http\Controllers;

use App\Models\CompanyImages;

use Illuminate\Http\Request;

class CompanyImagesController extends Controller
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
    public function multipleImageStore(Request $request)
    {
       $fileNames = array();
        foreach ($request->file('file') as $image) {
            $imageName = $image->getClientOriginalName();
            $image->move(public_path() . '/images/', $imageName);
            
            CompanyImages::create([
                 'url' => $imageName,
                'company_id' => $request->id

            ]);
        }

        //$images = json_encode($fileNames);

        // Store $images image in DATABASE from HERE 
        
        $current_images = CompanyImages::where('company_id',$request->id)->get();
        foreach ($current_images as $value) {
            $fileNames[] = $value->url;
        }
        return back()
            ->with('success', 'You have successfully upload.');
            /* ->with('files', $fileNames); */
    }
    public function removeImage($id){
        $image = CompanyImages::find($id);
        $image->delete();
        return redirect()->back()->with('message', '削除が完了しました。');
    }
}
