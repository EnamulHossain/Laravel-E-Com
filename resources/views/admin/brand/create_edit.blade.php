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
            <form action="{{ isset($brand) ? route('brand.update', $brand->id) : route('brand.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($category))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label class="form-label">Brand Name</label>
                    <input type="text" name="brand_name" class="form-control" placeholder="Brand Name" value="{{ isset($brand) ? $brand->brand_name : '' }}">
                    <div class="error">
                        @error('brand_name')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Brand Slug</label>
                    <input type="text" name="brand_slug" class="form-control" placeholder="Brand Slug" value="{{ isset($brand) ? $brand->brand_slug : '' }}">
                    <div class="error">
                        @error('brand_slug')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Brand Logo</label>
                    <input type="file" name="brand_logo" class="form-control">
                </div>
                <div class="error">
                    @error('brand_logo')
                        {{ $message }}
                    @enderror
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <a type="reset" href="{{route('brand.index')}}" class="btn btn-light">Cancel</a>
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
