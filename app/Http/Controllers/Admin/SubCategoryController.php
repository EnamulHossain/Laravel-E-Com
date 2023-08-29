<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
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
        $subcategories = SubCategory::with('category')->get();
        return view('admin.subcategory.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.subcategory.create_edit', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubCategoryRequest $request)
    {
        $subcategory = new SubCategory([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => $request->subcategory_slug,
        ]);
    
        $subcategory->save();

        return redirect()->route('subcategory.index')->with('success', 'Subcategory created successfully!');
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
    public function edit(SubCategory $subcategory)
    {
        $categories = Category::all();

        return view('admin.subcategory.create_edit', compact('subcategory', 'categories'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(SubCategoryRequest $request, SubCategory $subcategory)
    {
        if ($request->fails()) {
            return redirect()->back()->withErrors($request->errors())->withInput();
        }

        $validatedData = $request->all();

        $subcategory->update([
            'category_id' => $validatedData['category_id'],
            'subcategory_name' => $validatedData['subcategory_name'],
            'subcategory_slug' => $validatedData['subcategory_slug'],
        ]);

        return redirect()->route('subcategory.index')->with('success', 'Subcategory updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subcategory)
    {
        // Delete the SubCategory from the database
        $subcategory->delete();

        // Redirect the user back to the subcategories index page with a success message
        return redirect()->route('subcategory.index')->with('success', 'Subcategory deleted successfully!');
    }
}
