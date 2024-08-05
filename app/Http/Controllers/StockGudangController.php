<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\StockGudang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class StockGudangController extends Controller
{
    public function index()
    {
        $stock = StockGudang::paginate(25);
        return view('admin.stock.index', compact('stock'));
    }

    public function create()
    {
        $barang = Barang::all();
        return view('admin.stock.create', compact('barang'));
    }

    public function edit($id)
    {
        $stock = StockGudang::findOrfail($id);
        return view('admin.stock.edit', compact('stock'));
    }

    public function store(Request $request)
    {
        $stock = StockGudang::create($request->only([
            'barang_id',
            'jml',
            'satuan_jumlah' // pcs, liter, kg
        ]));

        if($stock instanceof Model)
        {
            toastr()->success('Data has been updated successfully!');
            return to_route('stock.index');
        }else{
            toastr()->error('An Error!');
            return to_route('stock.create');
        }
    }

    public function update(Request $request, $id)
    {
        $stock = [
            'barang_id' => $request->barang_id,
            'jml' => $request->jml,
            'satuan_jumlah' => $request->satuan_jumlah
        ];

        $stockModel = StockGudang::findOrFail($id)->update($stock);
        if($stockModel)
        {
            toastr()->success('Data has been updated successfully!');
            return to_route('stock.index');
        }else{
            toastr()->error('Data Not Found!');
            return to_route('stock.edit');
        }
    }

    public function destroy($id)
    {
        StockGudang::findOrFail($id)->delete();
        toastr()->warning('Data Has Been Deleted Permanently!');
        return redirect()->back();
    }
}
