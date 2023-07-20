@extends('admin.layout.app')
@section('admin')
    <div class="card p-4 m-4">
        <div class="card-header">
            @if(isset($category))
                <h6 class="mb-0">EDIT CATEGORY</h6>
            @else
                <h6 class="mb-0">ADD CATEGORY</h6>
            @endif
        </div>

        <div class="card-body">
            <form action="{{ isset($category) ? route('category.update', $category->id) : route('category.store') }}" method="POST">
                @csrf
                @if(isset($category))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label class="form-label">Category Name</label>
                    <input type="text" name="category_name" class="form-control" placeholder="Category Name" value="{{ isset($category) ? $category->category_name : '' }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Category Slug</label>
                    <input type="text" name="category_slug" class="form-control" placeholder="Category Slug" value="{{ isset($category) ? $category->category_slug : '' }}">
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <button type="reset" class="btn btn-light">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        @if(isset($category))
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
