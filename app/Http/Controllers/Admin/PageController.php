<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=DB::table('pages')->latest()->get();
        return view('admin.setting.page.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.setting.page.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'page_position' => $request->input('page_position'),
            'page_name' => $request->input('page_name'),
            'page_title' => $request->input('page_title'),
            'page_slug' => $request->input('page_slug'),
            'page_description' => $request->input('page_description'),
        ];
    
        DB::table('pages')->insert($data);
        return view('admin.setting.page.index')->with('success', 'Page data created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $page = DB::table('pages')->where('id', $id)->first();
        return view('admin.setting.page.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $page = DB::table('pages')->where('id', $id)->first();
        return view('admin.setting.page.create_edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::table('pages')->where('id', $id)->update([
            'page_position' => $request->input('page_position'),
            'page_name' => $request->input('page_name'),
            'page_title' => $request->input('page_title'),
            'page_slug' => $request->input('page_slug'),
            'page_description' => $request->input('page_description'),
            'updated_at' => now(),
        ]);
        return redirect()->route('page.index')->with('success', 'Page data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('pages')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Page data deleted successfully.');
    }
}
