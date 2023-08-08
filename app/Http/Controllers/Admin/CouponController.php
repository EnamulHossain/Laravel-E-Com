<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class CouponController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $coupons = DB::table('coupons')->select('coupons.*')->get();
            return DataTables::of($coupons)
                ->addIndexColumn()
                ->addColumn('action', function ($coupon) {
                    return '
                        <a href="' . route('coupon.edit', $coupon->id) . '" class="ph-pen btn btn-primary ms-3"></a>
                        <form action="' . route('coupon.destroy', $coupon->id) . '" method="POST" class="d-inline">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="ph-trash btn btn-primary ms-3" onclick="return confirm(\'Are you sure you want to delete?\')"></button>
                        </form>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.coupon.index');
    }

    public function create()
    {
        return view('admin.coupon.create_edit');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'coupon_code' => 'required',
            'valid_date' => 'required',
            'type' => 'required',
            'coupon_amount' => 'required',
            'status' => 'required',
        ]);

        Coupon::create($data);

        return redirect()->route('coupon.index')->with('success', 'Coupon created successfully.');
    }

    public function edit(string $id)
    {
        $coupon = Coupon::findOrFail($id);

        return view('admin.coupon.create_edit', compact('coupon'));
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'coupon_code' => 'required',
            'valid_date' => 'required',
            'type' => 'required',
            'coupon_amount' => 'required',
            'status' => 'required',
        ]);

        $coupon = Coupon::findOrFail($id);
        $coupon->update($data);

        return redirect()->route('coupon.index')->with('success', 'Coupon updated successfully.');
    }

    public function destroy(string $id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        return redirect()->route('coupon.index')->with('success', 'Coupon deleted successfully.');
    }
}