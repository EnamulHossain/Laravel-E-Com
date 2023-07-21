@extends('admin.layout.app')

@section('admin')
<div>
    <a href="{{ route('childcategory.create') }}" type="button" class="mx-2 my-3 btn btn-primary">Create Child Category</a>
</div>
<div class="card p-4">
    <div class="table-responsive">
        <table class="table ytable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Sub Category Name</th>
                    <th>Child Category Name</th>
                    <th>Child Category Slug</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- DataTables will render the table rows dynamically -->
            </tbody>
        </table>
    </div>
</div>

<!-- Add DataTables script -->
@push('scripts')
<script>
    $(document).ready(function() {
        $('.ytable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('childcategory.index') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'subcategory.subcategory_name', name: 'subcategory.subcategory_name' },
                { data: 'child_category_name', name: 'child_category_name' },
                { data: 'child_category_slug', name: 'child_category_slug' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

@endpush

@endsection
