<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $warehouses = DB::table('warehouses')->select('warehouses.*')->get();
            return DataTables::of($warehouses)
                ->addIndexColumn()
                ->addColumn('action', function ($warehouse) {
                    return '
                        <a href="' . route('warehouse.edit', $warehouse->id) . '" class="ph-pen btn btn-primary ms-3"></a>
                        <form action="' . route('warehouse.destroy', $warehouse->id) . '" method="POST" class="d-inline">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="ph-trash btn btn-primary ms-3" onclick="return confirm(\'Are you sure you want to delete?\')"></button>
                        </form>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.warehouse.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.warehouse.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $name = $request->input('name');
        $address = $request->input('address');
        $phone = $request->input('phone');

        // Assuming you have a "warehouses" table
        DB::table('warehouses')->insert([
            'name' => $name,
            'address' => $address,
            'phone' => $phone,
        ]);

        return redirect()->route('warehouse.index')
            ->with('success', 'Warehouse created successfully.');
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
        $warehouse = DB::table('warehouses')->where('id', $id)->first();

        if (!$warehouse) {
            return redirect()->back()->with('error', 'Warehouse not found.');
        }
        return view('admin.warehouse.create_edit', compact('warehouse'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $name = $request->input('name');
        $address = $request->input('address');
        $phone = $request->input('phone');

        $affectedRows = DB::table('warehouses')
            ->where('id', $id)
            ->update([
                'name' => $name,
                'address' => $address,
                'phone' => $phone,
            ]);

        if ($affectedRows === 0) {
            return redirect()->back()->with('error', 'Warehouse not found or no changes were made.');
        }

        return redirect()->route('warehouse.index')->with('success', 'Warehouse updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deletedRows = DB::table('warehouses')->where('id', $id)->delete();

        if ($deletedRows === 0) {
            return redirect()->back()->with('error', 'Warehouse not found.');
        }

        return redirect()->route('warehouse.index')->with('success', 'Warehouse deleted successfully.');
    }
}
