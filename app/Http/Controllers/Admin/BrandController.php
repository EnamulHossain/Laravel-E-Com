<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('brands')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '<a href="' . route('brand.edit', $data->id) . '" class="ph-pen btn btn-primary ms-3"></a>
                    <form action="' . route('brand.destroy', $data->id) . '" method="POST" class="d-inline">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="ph-trash btn btn-primary ms-3" onclick="return confirm(\'Are you sure you want to delete?\')"></button>
                    </form>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.brand.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('brand_logo')) {
            $imagePath = $request->file('brand_logo')->store('brand_logos', 'public');
            $validatedData['brand_logo'] = $imagePath;
        }
    
        $brand = Brand::create([
            'brand_name' => $validatedData['brand_name'],
            'brand_slug' => $validatedData['brand_slug'],
            'brand_logo' => $validatedData['brand_logo'],
        ]);
        return redirect()->route('brand.index')->with('success', 'Brand created successfully!');
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
        $brand = Brand::find($id);

        if (!$brand) {
            return redirect()->back()->with('error', 'Category not found.');
        }
        return view('admin.brand.create_edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, Brand $brand)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('brand_logo')) {
            $imagePath = $request->file('brand_logo')->store('brand_logos', 'public');
            $validatedData['brand_logo'] = $imagePath;
        }
        
        $brand->update([
            'brand_name' => $validatedData['brand_name'],
            'brand_slug' => $validatedData['brand_slug'],
            'brand_logo' => $validatedData['brand_logo'],
        ]);
        return redirect()->route('brand.index')->with('success', 'Brand created successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::find($id);

        $brand->delete();

        return redirect()->route('brand.index')->with('success', 'Brand deleted successfully!');
    }
}
