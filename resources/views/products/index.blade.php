@extends('layouts.main')
@section('contenido')
        <div class="container"><br>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Lista de Productos
                            <a href="{{route('products.create')}}" class="btn btn-success btn-sm float-right">Nuevo Producto</a>
                        </div>
                        <div class="card-body">
                            {{-- solo se mostrare un vez --}}
                            @if (session('info'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>  {{session('info')}}  </strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                            @endif
                            <table class="table table-hover table-sm">
                                    <thead>
                                        <th>ID</th>
                                        <th>Descripcion</th>
                                        <th>Precio</th>
                                        <th>Acciones</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{$product->id}}</td>
                                                <td>{{$product->description}}</td>
                                                <td>{{$product->price}}</td>
                                                <td>
                                                    <a href="{{route('products.edit',$product->id)}}" class="btn btn-warning btn-sm">Editar</a>
                                                    {{--ejecuta el submit --}}
                                                    <a href="javascript: document.getElementById('delete-{{$product->id}}').submit()" class="btn btn-danger btn-sm">Eliminar</a>
                                                    {{-- lo reconoce el js por su id --}}
                                                    <form action="{{route('products.destroy',$product->id)}}" method="post" id="delete-{{$product->id}}">
                                                        @method('delete')
                                                        @csrf
                                                    </form> 
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            Bienvenido {{ auth()->user()->name  }}
                            <a href="javascript:document.getElementById('logout').submit()" class="btn btn-danger btn-sm float-right">Cerrar Sesion</a>
                            <form action="{{route('logout')}}" id="logout" style="display:none" method="POST">
                                @csrf
                            </form>
                            {{-- no puede estar sin el metodo csrf
                                route logout es propio de laravel para salir de sesion --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection




