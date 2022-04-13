<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'product_name' => 'required|max:60',
            'product_type' => 'required|in:snack,drink,drugs',
            'product_price' => 'required|numeric',
            'expired_at' => 'required|date'
        ]);

        if($validator -> fails()){
            return response()->json($validator->messages())->setStatusCode(422);
        }

        $validated = $validator->validated();

        Product::create([
            'product_name' => $validated['product_name'],
            'product_type' => $validated['product_type'],
            'product_price' => $validated['product_price'],
            'expired_at' => $validated['expired_at']
        ]);

        return response()->json('produk berhasil disimpan')->setStatusCode(201);
    }

    public function show(){
        $products = Product::all();

        return response()->json($products)->setStatusCode(201);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'product_name' => 'required|max:60',
            'product_type' => 'required|in:snack,drink,drugs',
            'product_price' => 'required|numeric',
            'expired_at' => 'required|date'
        ]);

        if($validator -> fails()){
            return response()->json($validator->messages())->setStatusCode(422);
        }

        $validated = $validator->validated();
        $checkData = Product::find($id);

        if($checkData){
            Product::where('id',$id)->update([
                'product_name' => $validated['product_name'],
                'product_type' => $validated['product_type'],
                'product_price' => $validated['product_price'],
                'expired_at' => $validated['expired_at']
            ]);
    
            return response()->json([
                'messages' => 'Data berhasil diupdate'
            ])->setStatusCode(201);
        }

        return response()->json([
            'messages' => 'Data tidak ditemukan'
        ])->setStatusCode(404);

    }

    public function destroy($id){
        $checkData = Product::find($id);

        if($checkData){
            Product::destroy($id);

            return response()->json([
                'messages' => 'Data berhasil dihapus'
            ])->setStatusCode(200);
        }

        return response()->json([
            'messages' => 'Data tidak ditemukan'
        ])->setStatusCode(404);
    }
}
