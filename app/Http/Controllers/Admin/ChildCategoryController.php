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
            // $childCategories = ChildCategory::with('category', 'subcategory')->get();
            $childCategories = DB::table('child_categories')
                ->join('categories', 'child_categories.category_id', '=', 'categories.id')
                ->join('subcategories', 'child_categories.subcategory_id', '=', 'subcategories.id')
                ->select('child_categories.*', 'categories.category_name as category', 'subcategories.subcategory_name as subcategory')
                ->get();
            return DataTables::of($childCategories)
                ->addIndexColumn()
                ->addColumn('action', function ($childCategory) {
                    return '
                        <a href="' . route('child_categories.edit', $childCategory->id) . '" class="ph-pen btn btn-primary ms-3"></a>
                        <form action="' . route('child_categories.destroy', $childCategory->id) . '" method="POST" class="d-inline">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="ph-trash btn btn-primary ms-3" onclick="return confirm(\'Are you sure you want to delete?\')"></button>
                        </form>
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
        ChildCategory::create([
            'category_id' => $request->input('category_id'),
            'subcategory_id' => $request->input('subcategory_id'),
            'child_category_name' => $request->input('child_category_name'),
            'child_category_slug' => $request->input('child_category_slug'),
        ]);
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
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $childcategories = ChildCategory::find($id);
        if (!$childcategories) {
            return redirect()->back()->with('error', 'Category not found.');
        }
        return view('admin.childcategory.create_edit',compact('childcategories','categories','subcategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ChildCategory $ChildCategory)
    {
        $ChildCategory->update([
            'category_id' => $request->input('category_id'),
            'subcategory_id' => $request->input('subcategory_id'),
            'child_category_name' => $request->input('child_category_name'),
            'child_category_slug' => $request->input('child_category_slug'),
        ]);
        return redirect()->route('child_categories.index')->with('success', 'Child Category Updated successfully!');
    }


    public function destroy($id)
    {
        $childcategories = ChildCategory::find($id);
        $childcategories->delete();

        return redirect()->route('child_categories.index')->with('success', 'Child Category deleted successfully!');
    }
}
