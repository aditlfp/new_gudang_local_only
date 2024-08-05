<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BarangController extends Controller
{

    public function  index()
    {
        $barang = Barang::paginate(25);
        return view('admin.barang.index', compact('barang'));
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('admin.barang.edit', compact('barang'));
    }

    public function create()
    {
        return view('admin.barang.create', compact('barang'));
    }

    public function store(Request $request)
    {
        $barang = Barang::create($request->only([
            'name',
            'type', // alat atau bahan
            'harga',
            'type_berat',  //kg, ml, ons, gram
            'desc'
        ]));

        if($barang instanceof Model)
        {
            toastr()->success('Data has been updated successfully!');
            return to_route('barang.index');
        }else{
            toastr()->error('An Error!');
            return to_route('stock.create');
        }

    }

    public function update(Request $request, $id)
    {
        $barang = [
            'name' => $request->name,
            'type' => $request->type,
            'harga' => $request->harga,
            'type_berat' => $request->type_berat,
            'desc' => $request->desc
        ];

        $barModel = Barang::findOrFail($id)->update($barang);
        if($barModel)
        {
            toastr()->success('Data has been updated successfully!');
            return to_route('barang.index');
        }else{
            toastr()->error('Data Not Found!');
            return to_route('barang.edit');
        }
    }

    public function destroy($id)
    {
        Barang::findOrFail($id)->delete();
        toastr()->warning('Data has been deleted permanently!');
        return redirect()->back();
    }
}
