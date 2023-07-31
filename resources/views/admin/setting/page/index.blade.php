@extends('admin.layout.app')
@section('admin')
    <div>
        <a href="{{route('page.create')}}" type="button" class="mx-2 my-3 btn btn-primary">Create Page</a>
    </div>
    <div class="card p-4">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>page_position</th>
                        <th>page_name</th>
                        <th>page_title</th>
                        <th>page_slug</th>
                        <th>page_description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $datas )
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$datas->page_position}}</td>
                            <td>{{$datas->page_name}}</td>
                            <td>{{$datas->page_title}}</td>
                            <td>{{$datas->page_slug}}</td>
                            <td>{{$datas->page_description}}</td>
                            <td>
                                <a href="{{ route('page.edit', $datas->id) }}" class="ph-pen btn btn-primary ms-3"></a>
                                <form method="post" action="{{ route('page.destroy', $datas->id) }}" style="display: inline;">
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
