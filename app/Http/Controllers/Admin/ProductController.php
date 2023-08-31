<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Str;
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
    public function store(ProductRequest $request)
    {
        try {
            $product = new Product();
            $product->name = $request->input('name');
            $product->slug = Str::slug($product->name);
            $product->code = $request->input('code');
            $product->category_id = $request->input('category_id');
            $product->subcategory_id = $request->input('subcategory_id');
            $product->childcategory_id = $request->input('childcategory_id');
            $product->brand_id = $request->input('brand_id');
            $product->tags = $request->input('tags');
            $product->purchase_price = $request->input('purchase_price');
            $product->description = $request->input('description');
            $product->sell_price = $request->input('sell_price');
            $product->dicount_price = $request->input('discount_price');
            $product->quantity = $request->input('quantity');
            $product->stock = $request->input('stock');
            $product->color = $request->input('color');
            $product->size = $request->input('size');
            $product->feature = $request->input('featured');
            $product->today_deal = $request->input('deal');
            $product->status = $request->input('status');

            // Handle thumbnail upload and storage
            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('products/thumbnails', 'public');
                $product->thumbnail = $thumbnailPath;
            }

            // Handle images upload and storage
            if ($request->hasFile('images')) {
                $imagePaths = [];
                foreach ($request->file('images') as $image) {
                    $imagePath = $image->store('products/images', 'public');
                    $imagePaths[] = $imagePath;
                }
                $product->images = $imagePaths;
            }

            // Save the product
            $product->save();

            return redirect()->route('product.index')->with('success', 'Product created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating the product.');
        }
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
