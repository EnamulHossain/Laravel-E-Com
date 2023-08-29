<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }


    public function create()
    {
        return view('admin.category.create_edit');
    }


    public function store(CategoryRequest $request)
    {
        if ($request->fails()) {
            return redirect()->back()->withErrors($request->errors())->withInput();
        }

        Category::create([
            'category_name' => $request->input('category_name'),
            'category_slug' => $request->input('category_slug'),
        ]);
        return redirect()->route('category.index')->with('success', 'Category created successfully!');
    }


    public function edit($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return redirect()->back()->with('error', 'Category not found.');
        }

        return view('admin.category.create_edit', compact('category'));
    }


    public function update(CategoryRequest $request, Category $category)
    {
        if ($request->fails()) {
            return redirect()->back()->withErrors($request->errors())->withInput();
        }

        $category->update([
            'category_name' => $request->input('category_name'),
            'category_slug' => $request->input('category_slug'),
        ]);
        return redirect()->route('category.index')->with('success', 'Category updated successfully!');
    }


    public function destroy(Category $category)
    {
        // Delete the category from the database
        $category->delete();

        // Optionally, you can add a success message and redirect the user to a specific page
        return redirect()->route('category.index')->with('success', 'Category deleted successfully!');
    }
}
