<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ChildCategoryController extends Controller
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
        if (request()->ajax()) {
            $childCategories = ChildCategory::with('category', 'subcategory')->get();
            // $childCategories = DB::table('child_categories')
            //     ->join('categories', 'child_categories.category_id', '=', 'categories.id')
            //     ->join('subcategories', 'child_categories.subcategory_id', '=', 'subcategories.id')
            //     ->select('child_categories.*', 'categories.category_name', 'subcategories.subcategory_name')
            //     ->get();
            return DataTables::of($childCategories)
                ->addColumn('action', function ($childCategory) {
                    return '
                        <a href="' . route('child_categories.show', $childCategory->id) . '" class="btn btn-sm btn-primary">View</a>
                        <a href="' . route('child_categories.edit', $childCategory->id) . '" class="btn btn-sm btn-warning">Edit</a>
                        <button type="button" class="btn btn-sm btn-danger delete-btn" data-id="' . $childCategory->id . '">Delete</button>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.childcategory.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        return view('admin.childcategory.create_edit', compact('categories', 'subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        ChildCategory::created($request->all());
        return redirect()->route('child_categories.index')->with('success', 'Child Category created successfully!');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
