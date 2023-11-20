@extends('layouts.auth-master')

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

    {{-- <form action="/register" method="POST">
        @csrf
        <h1>Create account</h1>
        {{-- @include('layouts.partials.messages') --}}
    {{-- <div class="form-floating mb-3">
            <input type="email" placeholder="example@gmail.com" name="email" class="form-control" id="exampleInputEmail1"
                aria-describedby="emailHelp">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="form-floating mb-3">
            <input type="text" placeholder="username" name="username" class="form-control" id="exampleInputPassword1">
            <label for="exampleInputPassword1" class="form-label">Username</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" placeholder="password" name="password" class="form-control" id="exampleInputPassword1">
            <label for="exampleInputPassword1" class="form-label">Password</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" placeholder="password" name="password_confirmation" class="form-control"
                id="exampleInputPassword1">
            <label for="exampleInputPassword1" class="form-label">Password confirmation</label>
        </div>
        <div class="mb-3">
            <a href="/login">Login</a>
        </div>
        <button type="submit" class="btn btn-primary">Crear cuenta</button>
    </form> --}}


    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header">
            <h3 class="text-center font-weight-light my-4">Registrarse</h3>
        </div>
        <div class="card-body">
            <form action="/register" method="POST">
                @csrf
                <div class="form-floating mb-3">
                    <input class="form-control" type="text" name="name" placeholder="text" autocomplete="off" />
                    <label for="inputEmail">Nombre </label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" type="text" name="email" placeholder="text" autocomplete="off" />
                    <label for="inputEmail">Correo </label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" type="text" name="username" placeholder="text" autocomplete="off" />
                    <label for="inputEmail">Usuario</label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" type="password" name="password" placeholder="Password" />
                    <label for="inputPassword">Contraseña</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" placeholder="password" name="password_confirmation" class="form-control"
                        id="exampleInputPassword1">
                    <label for="exampleInputPassword1" class="form-label">Confirmar contraseña</label>
                </div>
                <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                    <a class="small" href="/login">Inciar sesion</a>
                    <button type="submit" class="btn btn-primary">Ingresar</button>
                </div>
            </form>
        </div>

    </div>
@endsection
