@extends('admin.layout.app')
@section('admin')
    <div class="card p-4 m-4">
        <div class="card-header">
            @if(isset($subcategory))
                <h6 class="mb-0">EDIT SUB CATEGORY</h6>
            @else
                <h6 class="mb-0">ADD SUB CATEGORY</h6>
            @endif
        </div>

        <div class="card-body">
            <form action="{{ isset($subcategory) ? route('subcategory.update', $subcategory->id) : route('subcategory.store') }}" method="POST">
                @csrf
                @if(isset($subcategory))
                    @method('PUT')
                @endif
                <div class="mb-3 row">
                    <label class="col-form-label col-lg-3">Category</label>
                    <div class="">
                        <select class="form-control select" name="category_id" data-minimum-results-for-search="Infinity">
                            <optgroup label="Category">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        @if(isset($subcategory) && $subcategory->category_id === $category->id)
                                            selected
                                        @endif
                                    >{{ $category->category_name }}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">SubCategory Name</label>
                    <input type="text" name="subcategory_name" class="form-control" placeholder="Sub Category Name" value="{{ isset($subcategory) ? $subcategory->subcategory_name : '' }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">SubCategory Slug</label>
                    <input type="text" name="subcategory_slug" class="form-control" placeholder="Category Slug" value="{{ isset($subcategory) ? $subcategory->subcategory_slug : '' }}">
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <button type="reset" class="btn btn-light">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        @if(isset($subcategory))
                            Update <i class="ph-pencil-line ms-2"></i>
                        @else
                            Create <i class="ph-plus-circle-fill ms-2"></i>
                        @endif
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
