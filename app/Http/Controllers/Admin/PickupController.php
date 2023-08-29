<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PickupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (request()->ajax()) {
            $pickups = DB::table('pickup_points')->select('pickup_points.*')->get();
            return DataTables::of($pickups)
                ->addIndexColumn()
                ->addColumn('action', function ($pickup) {
                    return '
                        <a href="' . route('coupon.edit', $pickup->id) . '" class="ph-pen btn btn-primary ms-3"></a>
                        <form action="' . route('coupon.destroy', $pickup->id) . '" method="POST" class="d-inline">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="ph-trash btn btn-primary ms-3" onclick="return confirm(\'Are you sure you want to delete?\')"></button>
                        </form>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.pickuppoint.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pickupPointData = [
            'pickup_points_name' => $request->input('pickup_points_name'),
            'pickup_points_address' => $request->input('pickup_points_address'),
            'pickup_points_phone' => $request->input('pickup_points_phone'),
            'pickup_points_phone2' => $request->input('pickup_points_phone2'),
        ];
    
        DB::table('pickup_points')->insert($pickupPointData);
    
        return response()->json('success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('pickup_points')->where('id', $id)->delete();
        return response()->json('success');
    }
}
