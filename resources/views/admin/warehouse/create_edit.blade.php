@extends('admin.layout.app')
@section('admin')
    <div class="card p-4 m-4">
        <div class="card-header">
            @if(isset($warehouse))
                <h6 class="mb-0">EDIT CATEGORY</h6>
            @else
                <h6 class="mb-0">ADD CATEGORY</h6>
            @endif
        </div>

        <div class="card-body">
            <form action="{{ isset($warehouse) ? route('warehouse.update', $warehouse->id) : route('warehouse.store') }}" method="POST">
                @csrf
                @if(isset($warehouse))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label class="form-label"> Name</label>
                    <input type="text" name="name" class="form-control" placeholder=" Name" value="{{ isset($warehouse) ? $warehouse->name : '' }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" placeholder="Address" value="{{ isset($warehouse) ? $warehouse->address : '' }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" placeholder="Phone" value="{{ isset($warehouse) ? $warehouse->phone : '' }}">
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <button type="reset" class="btn btn-light">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        @if(isset($warehouse))
                            Update <i class="ph-pencil-line ms-2"></i>
                        @else
                            Create <i class="ph-plus-circle-fill ms-2"></i>
                        @endif
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
