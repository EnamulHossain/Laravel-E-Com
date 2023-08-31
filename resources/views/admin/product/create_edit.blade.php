@extends('admin.layout.app')
@section('admin')
    <div class="">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('product.store') }}" method="POST">
            @csrf
            <div class="">
                <div class="d-flex gap-8">
                    <div class="card-body flex col-lg-6 m-4">

                        <div class="mb-4">
                            <div class="fw-bold border-bottom pb-2 mb-3">Add Product</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Product Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="name">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Code</label>
                                    <input type="text" name="code" class="form-control" placeholder="code">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3 row">
                                    <label class="form-label">Category</label>
                                    <div class="">
                                        <select class="form-control select" data-minimum-results-for-search="Infinity"
                                            name="category_id">
                                            <optgroup label="Category">
                                                @foreach ($category as $category)
                                                    <option value="{{ $category->id }}"> {{ $category->category_name }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3 row">
                                    <label class="form-label">Sub Category</label>
                                    <div class="">
                                        <select class="form-control select" data-minimum-results-for-search="Infinity"
                                            name="subcategory_id">
                                            <optgroup label="Subcategory">
                                                @foreach ($subcategory as $subcategory)
                                                    <option value="{{ $subcategory->id }}">
                                                        {{ $subcategory->subcategory_name }} </option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3 row">
                                    <label class="form-label">Child Category</label>
                                    <div class="">
                                        <select class="form-control select" data-minimum-results-for-search="Infinity"
                                            name="childcategory_id">
                                            <optgroup label="Child Category">
                                                @foreach ($childcategory as $childcategory)
                                                    <option value="{{ $childcategory->id }}">
                                                        {{ $childcategory->child_category_name }} </option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3 row">
                                    <label class="form-label">Brand</label>
                                    <div class="">
                                        <select class="form-control select" data-minimum-results-for-search="Infinity"
                                            name="brand_id">
                                            <optgroup label="Brand">
                                                @foreach ($brand as $brand)
                                                    <option value="{{ $brand->id }}"> {{ $brand->brand_name }} </option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            {{-- <div class="col-lg-6">
                                <div class="mb-3 row">
                                    <label class="form-label">Pick Up Point</label>
                                    <div class="">
                                        <select class="form-control select" data-minimum-results-for-search="Infinity" name="pickup_points_id">
                                            <optgroup label="Pick Up Point">
                                                @foreach ($pickup as $pickup)
                                                    <option value="{{$pickup->id}}"> {{$pickup->name}} </option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="col-lg-6">
                                <div class="mb-3 row">
                                    <label class="form-label">Warehouse</label>
                                    <div class="">
                                        <select class="form-control select" data-minimum-results-for-search="Infinity"
                                            name="warehouse">
                                            <optgroup label="Warehouse">
                                                @foreach ($warehouse as $warehouse)
                                                    <option value=""> {{ $warehouse->name }} </option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3 row">
                                    <label class="form-label">Unit</label>
                                    <div class="">
                                        <select class="form-control select" data-minimum-results-for-search="Infinity"
                                            name="warehouse">
                                            <optgroup label="Unit">
                                                @foreach ($warehouse as $warehouse)
                                                    {{-- <option value=""> {{$warehouse->name}} </option> --}}
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Tags</label>
                                    <input type="text" name="tags" class="form-control" placeholder="tags">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">Purchase Price</label>
                                    <input type="text" name="purchase_price" class="form-control" placeholder="price">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">Sell Price</label>
                                    <input type="text" name="sell_price" class="form-control" placeholder="price">
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">Discount Price</label>
                                    <input type="text" name="discount_price" class="form-control"
                                        placeholder="Discount Price">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Quantity</label>
                                    <input type="text" name="quantity" class="form-control" placeholder="quantity">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Stock</label>
                                    <input type="number" name="stock" class="form-control" placeholder="stock">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Color</label>
                                    <input type="text" name="color" class="form-control" placeholder="Color">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Size</label>
                                    <input type="number" name="size" class="form-control" placeholder="size">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="">
                                <div class="">
                                    <label class="form-label">Description</label>
                                    <textarea cols="93" class="form-control" placeholder="Product Description"></textarea>
                                </div>
                            </div>


                        </div>


                    </div>


                    <div class="card-body col-lg-4 flex m-4">
                        <div class="mb-4">
                            <div class="fw-bold border-bottom pb-2 mb-3 mt-2">Examples</div>
                            <div>
                                <Label class="form-label">Thumbnail</Label>
                                <div class="flex items-center justify-center w-full">
                                    <label for="dropzone-file"
                                        class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                            </svg>
                                        </div>
                                        <input id="file" type="file" class="hidden" />
                                    </label>
                                </div>
                            </div>

                            <div class="row mb-3 mt-2">
                                <label class="form-label">More image</label>
                                <div class="">
                                    <input type="file" class="form-control" multiple>
                                </div>
                            </div>



                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="toggleFour" class="flex cursor-pointer select-none items-center"> Featured
                                        Product
                                        <div class="relative">
                                            <input type="checkbox" id="toggleFour" name="featured" value="1"
                                                class="sr-only" />
                                            <div class="box bg-dark block h-8 w-14 rounded-full"></div>
                                            <div
                                                class="dot absolute left-1 top-1 flex h-6 w-6 items-center justify-center rounded-full bg-white transition">
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="toggleFour" class="flex cursor-pointer select-none items-center"> Today's
                                        Deal
                                        <div class="relative">
                                            <input type="checkbox" name="deal" id="toggleFour" value="1"
                                                class="sr-only" />
                                            <div class="box bg-dark block h-8 w-14 rounded-full"></div>
                                            <div
                                                class="dot absolute left-1 top-1 flex h-6 w-6 items-center justify-center rounded-full bg-white transition">
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="toggleFour" class="flex cursor-pointer select-none items-center"> Status
                                        <div class="relative">
                                            <input type="checkbox" name="status" id="toggleFour" value="1"
                                                class="sr-only" />
                                            <div class="box bg-dark block h-8 w-14 rounded-full"></div>
                                            <div
                                                class="dot absolute left-1 top-1 flex h-6 w-6 items-center justify-center rounded-full bg-white transition">
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <button class="btn btn-info" type="submit">submit</button>
        </form>
    </div>
@endsection
