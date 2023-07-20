@extends('admin.layout.app')
@section('admin')
    <div>
        <a href="{{route('category.create')}}" type="button" class="mx-2 my-3 btn btn-primary">Create Category</a>
    </div>
    <div class="card p-4">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category Name</th>
                        <th>Category Slug</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category )
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->category_name}}</td>
                            <td>{{$category->category_slug}}</td>
                            <td>
                                <a href="{{ route('category.edit', $category->id) }}" class="ph-pen btn btn-primary ms-3"></a>
                                <form method="post" action="{{ route('category.destroy', $category->id) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="ph-trash btn btn-primary ms-3" onclick="return confirm('Are you sure you want to delete this category?')"></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
