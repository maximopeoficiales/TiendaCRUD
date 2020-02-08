@extends('layouts.main'){{-- heredo el contenido de ese blade --}}
@section('contenido'){{-- este el contenido que voy a inyectar --}}
        <div class="container"><br>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Editar Producto
                        </div>
                        <div class="card-body">
                            <form action=" {{route('products.update',$product->id)}} " method="post">
                                @method('put')
                                @csrf {{-- envia un token --}}

                                <div class="form-group">
                                    <label for="">Descripcion</label>
                                    <input type="text" class="form-control" name="description" value="{{$product->description}}">
                                </div>
                                <div class="form-group">
                                    <label for="">Precio</label>
                                    <input type="number" class="form-control" name="price" value="{{$product->price}}">
                                </div>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <a href=" {{route('products.index')}}  " class="btn btn-danger">Cancelar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
@endsection