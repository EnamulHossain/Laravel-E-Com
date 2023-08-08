@extends('admin.layout.app')
@section('admin')
    <div class="card p-4 m-4">
        <div class="card-header">
            @if(isset($coupon))
                <h6 class="mb-0">EDIT CATEGORY</h6>
            @else
                <h6 class="mb-0">ADD CATEGORY</h6>
            @endif
        </div>

        <div class="card-body">
            <form action="{{ isset($coupon) ? route('coupon.update', $coupon->id) : route('coupon.store') }}" method="POST">
                @csrf
                @if(isset($coupon))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label class="form-label">Code</label>
                    <input type="text" name="coupon_code" class="form-control" placeholder="coupon_code" value="{{ isset($coupon) ? $coupon->coupon_code : '' }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Type</label>
                    <select name="type" class="form-control">
                        <option value="Percent" {{ isset($coupon) && $coupon->type === 'Percent' ? 'selected' : '' }}>Percent</option>
                        <option value="Fixed" {{ isset($coupon) && $coupon->type === 'Fixed' ? 'selected' : '' }}>Fixed</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Amount</label>
                    <input type="text" name="coupon_amount" class="form-control" placeholder="coupon_amount" value="{{ isset($coupon) ? $coupon->coupon_amount : '' }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Valid Date</label>
                    <input type="date" name="valid_date" class="form-control" value="{{ isset($coupon) ? $coupon->valid_date : '' }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <input type="text" name="status" class="form-control" placeholder="status" value="{{ isset($coupon) ? $coupon->status : '' }}">
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <button type="reset" class="btn btn-light">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        @if(isset($coupon))
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
