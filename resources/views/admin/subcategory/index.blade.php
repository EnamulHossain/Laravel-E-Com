@extends('admin.layout.app')
@section('admin')
    <div>
        <a href="{{route('subcategory.create')}}" type="button" class="mx-2 my-3 btn btn-primary">Create SubCategory</a>
    </div>
    <div class="card p-4">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category Name</th>
                        <th>Sub Category Name</th>
                        <th>Sub Category Slug</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subcategories as $subcategory )
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$subcategory->category->category_name}}</td>
                            <td>{{$subcategory->subcategory_name}}</td>
                            <td>{{$subcategory->subcategory_slug}}</td>
                            <td>
                                <a href="{{ route('subcategory.edit', $subcategory->id) }}" class="ph-pen btn btn-primary ms-3"></a>
                                <form method="post" action="{{ route('subcategory.destroy', $subcategory->id) }}" style="display: inline;">
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
