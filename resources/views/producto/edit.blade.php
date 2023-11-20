@extends('template')

@section('title', 'Editar Productos')

@push('css')
    <style>
        #descripcion {
            resize: none;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
@endpush

@section('content')


    <div class="container-fluid px-4">
        <h1 class="mt-4 text-center">Editar productos</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('productos.index') }}">Productos</a></li>
            <li class="breadcrumb-item active">Editar productos</li>
        </ol>

        <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
            <form action="{{ route('productos.update', ['producto' => $producto]) }}" method="post"
                enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="row g-3">
                    {{-- nombre --}}
                    <div class="col-md-6 mb-2">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control"
                            value="{{ old('nombre', $producto->nombre) }}">
                        @error('nombre')
                            <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    {{-- Descripcion --}}
                    <div class="col-md-12">
                        <label for="descripcion" class="form-label">Descripcion:</label>
                        <textarea name="descripcion" id="descripcion" rows="3" class="form-control">{{ old('descripcion', $producto->descripcion) }}</textarea>
                        @error('descripcion')
                            <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>

                    {{-- Precio unitario --}}
                    <div class="col-md-6 mb-2">
                        <label for="precio_unitario" class="form-label">Precio Unitario:</label>
                        <input type="text" name="precio_unitario" id="precio_unitario" class="form-control"
                            value="{{ old('precio_unitario', $producto->precio_unitario) }}">
                        @error('precio_unitario')
                            <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>
                    {{-- imagen --}}
                    <div class="col-md-6 mb-2">
                        <label for="img_path" class="form-label">Imagen:</label>
                        <input type="file" name="img_path" id="img_path" class="form-control" accept="Imagen/*"
                            value="{{ old('img_path') }}">
                        @error('img_path')
                            <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>
                    {{-- Categoria --}}
                    <div class="col-md-6 mb-2">
                        <label for="categoria_id" class="form-label">Categoria:</label>
                        <select name="categoria_id" id="categoria_id" class="form-control">
                            @foreach ($categorias as $item)
                                @if ($producto->categoria_id == $item->id)
                                    <option selected value="{{ $item->id }}">
                                        {{ $item->nombre }}</option>
                                @else
                                    <option value="{{ $item->id }}">
                                        {{ $item->nombre }}</option>
                                @endif
                            @endforeach
                        </select>
                        {{-- value="{{ old('categoria_id') }}"> --}}
                        @error('categoria_id')
                            <small class="text-danger">{{ '*' . $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
        </div>

    </div>
    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
    @endpush

@endsection
