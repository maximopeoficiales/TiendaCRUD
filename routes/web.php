<?php

use illuminate\http\Request;
use App\Product;/* uso el namespace osea el modelo de datos */

Route::middleware('auth')->group(function(){

    Route::get('/products', function () {
        /* guarda todos los datos en $products ejm: Product::all()*/
        $products = Product::orderby('created_at', 'desc')->get();
        return view('products.index', compact('products'));/* envia variable a la vista */
    })->name('products.index');
    
    Route::get('products/create', function () {
    
        return view('products.create');
    })->name('products.create');
    
    Route::post('products', function (Request $request) {
        /* $request->all(); */
        /* request captura los datos por post*/
        $newProduct = new Product;
        $newProduct->description = $request->input('description');
        $newProduct->price = $request->input('price');
        $newProduct->save();/* se guardan datos en el objeto */
    
        return redirect()->route('products.index')->with('info', 'Producto Registrado exitosamente');
        /* le envia a la pagina un mensaje flash que se guarga en la variable de session */
    })->name('products.store');
    
    Route::delete('products/{id}', function ($id) {
        $product = Product::findOrFail($id);
        /* return $product; retorna un json con los datos*/
        $product->delete();
        return redirect()->route('products.index')->with('info', 'Producto eliminado exitosamente');
    })->name('products.destroy');
    
    Route::get('products/{id}/edit', function ($id) {
        $product = Product::findOrFail($id);
    
        return view('products.edit', compact('product'));
    })->name('products.edit');
    
    Route::put('/products/{id}', function (Request $request, $id) {
        $product = Product::findOrFail($id);/* encuenta el producto */
        $product->description = $request->input('description');/* guarda los datos del request al objeto */
        $product->price = $request->input('price');
        $product->save();/* guarda los datos */
        return redirect()->route('products.index')->with('info', 'Producto Actualizado exitosamente');
    })->name('products.update');
    
});

Auth::routes();

/* Route::get('/home', 'HomeController@index')->name('home'); */
