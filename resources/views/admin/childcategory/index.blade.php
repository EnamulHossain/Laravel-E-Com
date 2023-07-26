@extends('admin.layout.app')

@section('admin')
    <div>
        <a href="{{ route('child_categories.create') }}" type="button" class="mx-2 my-3 btn btn-primary">Create Child
            Category</a>
    </div>
    <div class="card p-4">
        <div class="table-responsive">
            <table class="table datatable-pagination" id="child-categories-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Subcategory</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

    <!-- Add DataTables script -->
    <script>
        $(document).ready(function() {
            $('#child-categories-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('child_categories.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'category',
                        name: 'category'
                    },
                    {
                        data: 'subcategory',
                        name: 'subcategory'
                    },
                    {
                        data: 'child_category_name',
                        name: 'child_category_name'
                    },
                    {
                        data: 'child_category_slug',
                        name: 'child_category_slug'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });

            // Handle delete button click
            $('#child-categories-table').on('click', '.delete-btn', function() {
                let childCategoryId = $(this).data('id');

                if (confirm('Are you sure you want to delete this child category?')) {
                    $.ajax({
                        url: "{{ route('child_categories.destroy', ':id') }}".replace(':id',
                            childCategoryId),
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            $('#child-categories-table').DataTable().ajax.reload();
                        },
                        error: function(data) {
                            console.log('Error:', data);
                        }
                    });
                }
            });
        });
    </script>
@endsection
