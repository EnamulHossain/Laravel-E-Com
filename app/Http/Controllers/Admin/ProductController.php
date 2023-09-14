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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (request()->ajax()) {
            $products = DB::table('products')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->join('subcategories', 'products.subcategory_id', '=', 'subcategories.id')
                ->join('child_categories', 'products.childcategory_id', '=', 'child_categories.id')
                ->join('brands', 'products.brand_id', '=', 'brands.id')
                ->select('products.*', 'categories.category_name as category', 'subcategories.subcategory_name as subcategory', 'child_categories.child_category_name as child_categories', 'brands.brand_name as brand')
                ->get();
            return DataTables::of($products)
                ->addIndexColumn()
                ->addColumn('action', function ($product) {
                    return '
                    <a href="' . route('product.edit', $product->id) . '" class="ph-pen btn btn-primary ms-3"></a>
                    <form action="' . route('product.destroy', $product->id) . '" method="POST" class="d-inline">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="ph-trash btn btn-primary ms-3" onclick="return confirm(\'Are you sure you want to delete?\')"></button>
                    </form>
                ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.product.index');
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
                $thumbnail = $request->file('thumbnail');

                $thumbnailName = time() . '_' . $thumbnail->getClientOriginalName();
                $thumbnailPath = $thumbnail->storeAs('products/thumbnails', $thumbnailName, 'public');
                $product->thumbnail = $thumbnailPath;
            }

            // Handle images upload and storage
            // Handle images upload and storage
            if ($request->hasFile('images')) {
                $imagePaths = []; // Initialize an array to store image paths

                foreach ($request->file('images') as $image) {
                    if ($image->isValid()) {
                        $imageName = time() . '_' . $image->getClientOriginalName();
                        $imagePath = $image->storeAs('products/images', $imageName, 'public');
                        $imagePaths[] = $imagePath;
                    } else {
                    }
                }
                $product->images = $imagePaths;
            }


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
    public function edit($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('product.index')->with('error', 'Product not found.');
        }

        // Fetch necessary data for dropdowns or other form elements (similar to your create method)
        $category = Category::all();
        $subcategory = SubCategory::all();
        $childcategory = ChildCategory::all();
        $brand = Brand::all();
        $pickup = PickupPoint::all();
        $warehouse = Warehouse::all();

        $data = [
            'product' => $product,
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
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, $id)
    {
        try {
            $product = Product::find($id);
            if (!$product) {
                return redirect()->route('product.index')->with('error', 'Product not found.');
            }

            // Update the product fields based on the request data (similar to your store method)
            $product->name = $request->input('name');
            $product->slug = Str::slug($product->name);
            $product->code = $request->input('code');
            // ... Update other fields ...

            // Handle thumbnail update if a new one is uploaded
            if ($request->hasFile('thumbnail')) {
                // Delete the old thumbnail if needed
                // Store and update the new thumbnail
            }

            // Handle images update if new ones are uploaded
            if ($request->hasFile('images')) {
                // Delete the old images if needed
                // Store and update the new images
            }

            $product->save();
            return redirect()->route('product.index')->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the product.');
        }
    }

    private function deleteProductImagesAndThumbnail($product)
    {
        // Delete images
        if (!empty($product->images)) {
            foreach ($product->images as $image) {
                // Construct the full path to the image
                $imagePath = 'public/' . $image;

                // Check if the image exists in storage and delete it
                if (Storage::exists($imagePath)) {
                    Storage::delete($imagePath);
                }
            }
        }

        // Delete the thumbnail
        if (!empty($product->thumbnail)) {
            // Construct the full path to the thumbnail
            $thumbnailPath = 'public/' . $product->thumbnail;

            // Check if the thumbnail exists in storage and delete it
            if (Storage::exists($thumbnailPath)) {
                Storage::delete($thumbnailPath);
            }
        }
    }

    public function destroy($id)
    {
        try {
            $product = Product::find($id);
            if (!$product) {
                return redirect()->route('product.index')->with('error', 'Product not found.');
            }

            // Delete associated images and thumbnail
            $this->deleteProductImagesAndThumbnail($product);

            // Delete the product
            $product->delete();
            return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the product.');
        }
    }
}
