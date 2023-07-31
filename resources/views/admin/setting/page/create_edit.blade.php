@extends('admin.layout.app')
@section('admin')
    <div class="card p-4 m-4">
        <div class="card-header">
            @if (isset($page))
                Edit Page
            @else
                Create Page
            @endif
        </div>
        <div class="card-body">
            <form method="POST"
                action="@if (isset($page)) {{ route('page.update', $page->id) }}@else{{ route('page.store') }} @endif">
                @csrf
                @if (isset($page))
                    @method('PUT')
                @endif
                <div class="mb-3">
                    <label for="page_position">Page Position</label>
                    <input type="text" name="page_position" id="page_position" class="form-control"
                        value="{{ isset($page) ? $page->page_position : old('page_position') }}" required>
                </div>
                <div class="mb-3">
                    <label for="page_name">Page Name</label>
                    <input type="text" name="page_name" id="page_name" class="form-control"
                        value="{{ isset($page) ? $page->page_name : old('page_name') }}" required>
                </div>
                <div class="mb-3">
                    <label for="page_title">Page Title</label>
                    <input type="text" name="page_title" id="page_title" class="form-control"
                        value="{{ isset($page) ? $page->page_title : old('page_title') }}" required>
                </div>
                <div class="mb-3">
                    <label for="page_slug">Page Slug</label>
                    <input type="text" name="page_slug" id="page_slug" class="form-control"
                        value="{{ isset($page) ? $page->page_slug : old('page_slug') }}" required>
                </div>
                <div class="mb-3">
                    <label for="page_description">Page Description</label>
                    <textarea name="page_description" id="page_description" class="form-control" required>{{ isset($page) ? $page->page_description : old('page_description') }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">
                    @if (isset($page))
                        Update
                    @else
                        Create
                    @endif
                </button>
            </form>
        </div>
    </div>
@endsection
