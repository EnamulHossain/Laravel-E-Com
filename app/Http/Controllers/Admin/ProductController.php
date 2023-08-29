<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\PickupPoint;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        $subcategory = SubCategory::all();
        $childcategory = ChildCategory::all();
        $brand = Brand::all();
        $pickup = PickupPoint::all();
        $warehouse = Warehouse::all();

        $data = [
            'category' => $category,
            'subcategory' => $subcategory,
            'childcategory' => $childcategory,
            'brand' => $brand,
            'pickup' => $pickup,
            'warehouse' => $warehouse,
        ];
        return view('admin.product.create_edit', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request);
        $validatedData = $request->validate([
            'category_id' => 'required|integer',
            'subcategory_id' => 'nullable|integer',
            'childcategory_id' => 'nullable|integer',
            'brand_id' => 'required|integer',
            'pickup_points_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products',
            'code' => 'required|string|max:255',
            'unit' => 'required|string|max:50',
            'tags' => 'nullable|string|max:255',
            'video' => 'nullable|string|max:255',
            'price' => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'quantity' => 'required|integer',
            'description' => 'nullable|string',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'feature' => 'required|boolean',
            'today_deal' => 'required|boolean',
            'status' => 'required|boolean',
            'sku' => 'nullable|string|max:255',
            'flash_deal_id' => 'nullable|integer',
            'cash_on_delivery' => 'required|boolean',
            'warehouse' => 'required|string|max:255',
            'admin_id' => 'required|integer',
        ]);

        // Handle thumbnail upload and storage
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('products/thumbnails', 'public');
            $validatedData['thumbnail'] = $thumbnailPath;
        }

        // Handle images upload and storage
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('products/images', 'public');
                $imagePaths[] = $imagePath;
            }
            $validatedData['images'] = $imagePaths;
        }

        $product = new Product($validatedData);
        $product->save();

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
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
