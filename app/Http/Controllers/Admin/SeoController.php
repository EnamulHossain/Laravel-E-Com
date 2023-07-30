<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=DB::table('seos')->first();
        return view('admin.setting.seo',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data=array();
        $data['meta_title']=$request->meta_title ;
        $data['meta_author']=$request->meta_author ;
        $data['meta_tag']=$request->meta_tag ;
        $data['meta_descripition']=$request->meta_descripition ;
        $data['meta_keyword']=$request->meta_keyword ;
        $data['google_verification']=$request->google_verification ;
        $data['google_analytics']=$request->google_analytics ;
        $data['alexa_verification']=$request->alexa_verification ;
        $data['google_adsense']=$request->google_adsense ;
        DB::table('seos')->where('id',$id)->update($data);
        return redirect()->back()->with('success', 'SEO data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
