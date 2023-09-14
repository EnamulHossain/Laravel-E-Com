@extends('admin.layout.app')

@section('admin')
    <div>
        <a href="{{ route('product.create') }}" type="button" class="mx-2 my-3 btn btn-primary">Create Product</a>
    </div>
    <div class="card p-4">
        <div class="table-responsive">
            <table class="table datatable-pagination" id="products-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Thumbnail</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Subcategory</th>
                        <th>Childcategory</th>
                        <th>Brand</th>
                        <th>Tags</th>
                        <th>Purchase Price</th>
                        <th>Description</th>
                        <th>Sell Price</th>
                        <th>Discount Price</th>
                        <th>Quantity</th>
                        <th>Stock</th>
                        <th>Color</th>
                        <th>Size</th>
                        <th>Featured</th>
                        <th>Deal</th>
                        <th>Status</th>
                        <th>Images</th>
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
            $('#products-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('product.index') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'thumbnail', name: 'thumbnail' },

                    // {
                    //     data: 'thumbnail',
                    //     name: 'thumbnail', 
                    //     render: function (data, type, full, meta) {
                    //         return '<img src="' + data + '" alt="Thumbnail" style="max-width: 100px; max-height: 100px;">';
                    //     }
                    // },
                    { data: 'name', name: 'name' },
                    { data: 'category', name: 'category' },
                    { data: 'subcategory', name: 'subcategory' },
                    { data: 'child_categories', name: 'child_categories' },
                    { data: 'brand', name: 'brand' },
                    { data: 'tags', name: 'tags' },
                    { data: 'purchase_price', name: 'purchase_price' },
                    { data: 'description', name: 'description' },
                    { data: 'sell_price', name: 'sell_price' },
                    { data: 'discount_price', name: 'discount_price' },
                    { data: 'quantity', name: 'quantity' },
                    { data: 'stock', name: 'stock' },
                    { data: 'color', name: 'color' },
                    { data: 'size', name: 'size' },
                    { data: 'feature', name: 'feature' },
                    { data: 'today_deal', name: 'today_deal' },
                    { data: 'status', name: 'status' },
                    // { data: 'images', name: 'images' },
                    { data: 'images', name: 'images',
                        render: function(data, type, full, meta) {
                            var imageHtml = '';
                            if (data && data.length > 0) {
                                data.forEach(function(image) {
                                    imageHtml += '<img src="' + image + '" alt="Product Image" style="max-width: 100px; max-height: 100px;">&nbsp;';
                                });
                            }
                            return imageHtml;
                        }
                    },
                    { data: 'action', name: 'action', orderable: true, searchable: true },
                ]
            });

            // Handle delete button click
            $('#products-table').on('click', '.delete-btn', function() {
                let productId = $(this).data('id');

                if (confirm('Are you sure you want to delete this product?')) {
                    $.ajax({
                        url: "{{ route('product.destroy', ':id') }}".replace(':id', productId),
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            $('#products-table').DataTable().ajax.reload();
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
