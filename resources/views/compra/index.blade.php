@extends('template')

@section('title', 'compras')

@push('css')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush

@section('content')

    @if (session('success'))
        <script>
            let message = "{{ session('success') }}"
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: message
            });
        </script>
    @endif

    <div class="container-fluid px-4">
        <h1 class="mt-4 text-center">Compras</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Compras</li>
        </ol>
        @guest
            <p>Para realizar una compra debe iniciar sesion: <a href="/login">Inicio de sesion</a></p>
        @endguest

        @auth
            <div class="mb-4">
                <a href="{{ route('compras.create') }}">
                    <button type="button" class="btn btn-primary">Añadir nueva compra</button>
                </a>
            </div>
        @endauth

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Tabla compras
            </div>

            <div class="card-body">
                <table id="datatablesSimple" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Precio Unitario</th>
                            <th>Categoria</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
        @push('js')
            <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
            <script src="{{ url('assets/js/datatables-simple-demo.js') }}"></script>
        @endpush

    @endsection
