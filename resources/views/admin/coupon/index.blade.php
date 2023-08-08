@extends('admin.layout.app')
@section('admin')
    <div>
        <a href="{{route('coupon.create')}}" type="button" class="mx-2 my-3 btn btn-primary">Create Category</a>
    </div>
    <div class="card p-4">
        <div class="table-responsive">
            <table class="table" id="coupons-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Code</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Valid Date</th>
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
            $('#coupons-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('coupon.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'coupon_code', name: 'coupon_code' },
                    { data: 'type', name: 'type' },
                    { data: 'coupon_amount', name: 'coupon_amount' },
                    { data: 'valid_date', name: 'valid_date'},
                    { data: 'action', name: 'action', orderable: true, searchable: true }
                ]
            });
        });
    </script>
@endsection
