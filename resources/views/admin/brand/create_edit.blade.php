@extends('admin.layout.app')
@section('admin')
    <div class="card p-4 m-4">
        <div class="card-header">
            @if(isset($brand))
                <h6 class="mb-0">EDIT BRAND</h6>
            @else
                <h6 class="mb-0">ADD BRAND</h6>
            @endif
        </div>

        <div class="card-body">
            <form action="{{ isset($brand) ? route('brand.update', $brand->id) : route('brand.store') }}" method="POST">
                @csrf
                @if(isset($category))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label class="form-label">Brand Name</label>
                    <input type="text" name="brand_name" class="form-control" placeholder="Brand Name" value="{{ isset($brand) ? $brand->brand_name : '' }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Brand Slug</label>
                    <input type="text" name="brand_slug" class="form-control" placeholder="Brand Slug" value="{{ isset($brand) ? $brand->brand_slug : '' }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Brand Slug</label>
                    <input type="text" name="brand_logo" class="form-control" placeholder="Brand Logo" value="{{ isset($brand) ? $brand->brand_logo : '' }}">
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <button type="reset" class="btn btn-light">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        @if(isset($brand))
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
