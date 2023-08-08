@extends('admin.layout.app')
@section('admin')
    <div>
        <a href="{{route('warehouse.create')}}" type="button" class="mx-2 my-3 btn btn-primary">Create Warehouse</a>
    </div>
    <div class="card p-4">
        <div class="table-responsive">
            <table class="table" id="warehouse-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone</th>
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
            $('#warehouse-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('warehouse.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'name', name: 'brand_name' },
                    { data: 'address', name: 'address' },
                    { data: 'phone', name: 'phone'},
                    { data: 'action', name: 'action', orderable: true, searchable: true }
                ]
            });
        });
    </script>
@endsection
