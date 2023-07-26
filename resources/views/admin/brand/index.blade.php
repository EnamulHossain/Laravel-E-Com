@extends('admin.layout.app')
@section('admin')
    <div>
        <a href="{{route('brand.create')}}" type="button" class="mx-2 my-3 btn btn-primary">Brand Create</a>
    </div>
    <div class="card p-4">
        <div class="table-responsive">
            <table class="table" id="brands-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Brand Name</th>
                        <th>Brand Slug</th>
                        <th>Brand Logo</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#brands-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('brand.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'brand_name', name: 'brand_name' },
                    { data: 'brand_slug', name: 'brand_slug' },
                    { data: 'brand_logo', name: 'brand_logo'},
                    { data: 'action', name: 'action', orderable: true, searchable: true }
                ]
            });
        });
    </script>
    
    
@endsection
