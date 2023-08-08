@extends('admin.layout.app')
@section('admin')
    <div>
        <a href="{{route('pickup-point.create')}}" type="button" class="mx-2 my-3 btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_centered">Create Pickup Point</a>
    </div>
    <div class="card p-4">
        <div class="table-responsive">
            <table class="table" id="pickup-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Phone Two</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>

    {{-- <script>
        $(document).ready(function () {
            $('#pickup-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('pickup-point.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'pickup_point_name', name: '	pickup_point_name' },
                    { data: 'pickup_point_address', name: 'pickup_point_address' },
                    { data: 'pickup_point_phone', name: 'pickup_point_phone'},
                    { data: 'pickup_point_phone2', name: 'pickup_point_phone2'},
                    { data: 'action', name: 'action', orderable: true, searchable: true }
                ]
            });
        });
    </script> --}}




<!-- Centered modal -->
<div id="modal_centered" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Basic modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form action="{{route('pickup-point.store') }}" method="POST" id="add_form">
                    @csrf
                    @if(isset($warehouse))
                        @method('PUT')
                    @endif
    
                    <div class="mb-3">
                        <label class="form-label"> Pickup Point Name</label>
                        <input type="text" name="pickup_point_name" class="form-control" placeholder=" pickup_point_name">
                    </div>
    
                    <div class="mb-3">
                        <label class="form-label">Pickup Point Address</label>
                        <input type="text" name="pickup_point_address" class="form-control" placeholder="pickup_point_address">
                    </div>
    
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" name="pickup_point_phone" class="form-control" placeholder="pickup_point_address">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone Two</label>
                        <input type="text" name="pickup_point_phone2" class="form-control" placeholder="pickup_point_phone_Second">
                    </div>
    
                    <div class="d-flex justify-content-between align-items-center">
                        <button type="reset" class="btn btn-light">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                                Create <i class="ph-plus-circle-fill ms-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /centered modal -->

{{-- // Store ajax call --}}
{{-- <script>
    $('#add_form').submit(function(e){
        e.preventDefault();
        $('.loading').removeClass('d-none');
        var url = $(this).attr('action');
        var request =$(this).serialize();
        $.ajax({
            url:url,
            type:'post',
            async:false,
            data:request,
            success:function(data){
                toastr.success(data);
                $('add_form')[0].reset();
                $('.loading').addClass('d-none');
                $('#addModal').modal('hide');
                table.ajax.reload();
            }
        });
    });
</script> --}}
<script>
    $(document).ready(function () {
        var table = $('#pickup-table').DataTable({
            processing: true,
                serverSide: true,
                ajax: "{{ route('pickup-point.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'pickup_point_name', name: '	pickup_point_name' },
                    { data: 'pickup_point_address', name: 'pickup_point_address' },
                    { data: 'pickup_point_phone', name: 'pickup_point_phone'},
                    { data: 'pickup_point_phone2', name: 'pickup_point_phone2'},
                    { data: 'action', name: 'action', orderable: true, searchable: true }
                ]
        });

        $('#add_form').submit(function(e){
            e.preventDefault();
            $('.loading').removeClass('d-none');
            var url = $(this).attr('action');
            var request =$(this).serialize();
            $.ajax({
                url:url,
                type:'post',
                async:false,
                data:request,
                success:function(data){
                    toastr.success(data);
                    $('#add_form')[0].reset(); // Corrected this line
                    $('.loading').addClass('d-none');
                    $('#modal_centered').modal('hide'); // Corrected modal ID
                    table.ajax.reload(); // Corrected table reloading
                }
            });
        });
    });
</script>
@endsection
