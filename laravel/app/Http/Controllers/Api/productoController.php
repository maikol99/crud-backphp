<?php

namespace App\Http\Controllers\Api;

use App\Models\Producto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class productoController extends Controller
{
    public function index()
    {
        $producto = producto::all();
        
        if($producto->count() > 0){

            return response()->json([
                'status' => 200,
                'producto' => $producto
            ], 200);
        }else{

            return response()->json([
                'status' => 404,
                'message' => 'no records found'
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
         'id' => 'required|integer|max:20',
         'name' => 'required|string|max:255',
        'categoria'=> 'required|integer|max:20',
        'iva' => 'required|numeric|min:0|max:100',
        'price' =>  'required|numeric|regex:/^\d{1,14}(\.\d{1,2})?$/',
        'stock' =>  'required|integer|max:11'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ],422);

        }else{

            $producto = producto::create([
                'id' => $request -> id,
                'name' => $request -> name,
                'categoria'=> $request -> categoria,
                'iva' => $request -> iva,
                'price' => $request -> price,
                'stock' =>  $request -> stock,
            ]);

            if($producto){

                return response()->json([
                    'status' => 200,
                    'message' => 'producto creado con exito'
                ],200);
                
            }else{

                return response()->json([
                    'status' => 500,
                    'message' => 'algo salio mal'
                ],500);
            }
        }
    }

    public function show($id)
    {
        $producto = producto::find($id);
        if($producto){

            return response()->json([
                'status' => 200,
                'producto' => $producto
            ],200);
        }else{

            return response()->json([
                'status' => 404,
                'message' => 'nose encontro el producto'
            ],404);
        }
    }


    public function edit($id)
    {
        $producto = producto::find($id);
        if($producto){

            return response()->json([
                'status' => 200,
                'producto' => $producto
            ],200);
        }else{

            return response()->json([
                'status' => 404,
                'message' => 'nose encontro el producto'
            ],404);
        }
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(),[
            'id' => 'required|integer|max:20',
            'name' => 'required|string|max:255',
           'categoria'=> 'required|integer|max:255',
           'price' =>  'required|numeric|regex:/^\d{1,14}(\.\d{1,2})?$/',
           'iva' => 'required|numeric|min:0|max:100',
           'stock' =>  'required|numeric|min:0|max:100',
           ]);
   
           if($validator->fails()){
               return response()->json([
                   'status' => 422,
                   'errors' => $validator->messages()
               ],422);
   
           }else{

               $producto = producto::find($id);

   
               if($producto){

                $producto->update([
                    'id' => $request -> id,
                    'name' => $request -> name,
                    'categoria'=> $request -> categoria,
                    'iva' => $request -> iva,
                    'price' => $request -> price,
                    'stock' =>  $request -> stock,
                ]);
    
   
                   return response()->json([
                       'status' => 200,
                       'message' => 'producto actualizado con exito'
                   ],200);
                   
               }else{
   
                   return response()->json([
                       'status' => 404,
                       'message' => 'nose encontro tal producto'
                   ],404);
               }
           }
    }

    public function destroy($id)
    {
        $producto = producto::find($id);
        if($producto){

            $producto->delete();
            return response()->json([
                'status' => 404,
                'message' => 'producto eliminado'
            ],404);
        
            
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'nose encontro tal producto'
            ],404);
        }
    }
}