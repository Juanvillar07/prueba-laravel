@extends('layouts.auth-master')

@section('content')
    {{-- <div class="container">
        <h1>LOGIN</h1>
        <form action="/login" method="POST">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Usuario / Correo</label>
                <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <a href="/register">Crear cuenta</a>
            </div>
            <button type="submit" class="btn btn-primary">Ingresar</button>
        </form>
    </div> --}}

    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header">
            <h3 class="text-center font-weight-light my-4">Login</h3>
        </div>
        <div class="card-body">
            <form action="/login" method="POST">
                @csrf
                <div class="form-floating mb-3">
                    <input class="form-control" type="text" name="username" placeholder="text" autocomplete="off" />
                    <label for="inputEmail">Usuario / correo </label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" type="password" name="password" placeholder="Password" />
                    <label for="inputPassword">Contraseña</label>
                </div>

                <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                    <a class="small" href="/register">Crear cuenta</a>
                    <button type="submit" class="btn btn-primary">Ingresar</button>
                </div>
            </form>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
