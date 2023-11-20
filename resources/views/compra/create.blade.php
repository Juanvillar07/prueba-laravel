@extends('template')

@section('title', 'Crer compra')

@push('css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')

    <script>
        function actualizarPrecio() {
            // Obtén el select de producto y el producto seleccionado actualmente
            var selectProducto = document.getElementById('producto_id');
            var productoSeleccionado = selectProducto.options[selectProducto.selectedIndex];

            // Obtén el precio unitario del producto seleccionado
            var precioUnitario = productoSeleccionado.getAttribute('data-precio-unitario');

            // Establece el precio unitario en el campo de precio de compra
            document.getElementById('precio_compra').value = precioUnitario;
        }


        // document.addEventListener('DOMContentLoaded', function() {
        //     actualizarPrecio(); // Esto configura el valor inicial para precio_compra
        // });
    </script>

    <div class="container-fluid px-4">
        <h1 class="mt-4 text-center">Crear compras</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('compras.index') }}">Compra</a></li>
            <li class="breadcrumb-item active">Crear compra</li>
        </ol>
    </div>
    <form action="{{ route('compras.store') }}" method="post">
        @csrf
        <div class="container mt-4">
            <div class="row gy-4">
                {{-- Compra producto --}}
                <div class="col-md-8">
                    <div class="text-white bg-primary p-1 text-center">
                        Detalles de la compra
                    </div>
                    <div class="p-3 border border-3 border-primary">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <select name="producto_id" id="producto_id" class="form-select"
                                    onchange="actualizarPrecio()">
                                    @foreach ($productos as $item)
                                        <option value="{{ $item->id }}"
                                            data-precio-unitario="{{ $item->precio_unitario }}">
                                            {{ $item->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                {{-- <select name="producto_id" id="producto_id" class="form-select">
                                    @foreach ($productos as $item)
                                        <option value="{{ $item->id }}">{{ $item->id . '   -     ' . $item->nombre }}
                                        </option>
                                    @endforeach
                                </select> --}}
                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="cantidad" class="form-label">Cantidad:</label>
                                <input type="number" name="cantidad" id="cantidad" class="form-control">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="precio_compra" class="form-label">Precio:</label>
                                <input type="number" name="precio_compra" id="precio_compra" class="form-control"
                                    step="0.1">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="impuesto" class="form-label">Impuesto:</label>
                                <input readonly type="text" name="impuesto" id="impuesto" class="form-control"
                                    step="0.1">
                            </div>


                            <div class="col-md-12 mb-2 mt-2 text-end">
                                <button id="btn_agregar" class="btn btn-primary" type="button">Agregar</button>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="tabla_detalle" class="table table-hover">
                                        <thead class="bg-primary text-white">
                                            <tr>
                                                <th>#</th>
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                                <th>Precio compra</th>
                                                <th>Subototal</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th></th>
                                                <th> </th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th colspan="4">Sumas</th>
                                                <th colspan="2"><span id="sumas">0</span></th>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <th colspan="4">IGV %</th>
                                                <th colspan="2"><span id="igv">0</span></th>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <th colspan="4">Total</th>
                                                <th colspan="2"><span id="total">0</span></th>
                                            </tr>
                                        </tfoot>

                                    </table>
                                    <div class="col-md-6 mb-2 mt-2">
                                        <button id="btnCancelarCompra" class="btn btn-warning" type="button">Restaurar
                                            compra</button>
                                    </div>
                                    <div class="col-md-6 mb-2 mt-2">
                                        <button id="btnCancelarCompra" class="btn btn-success" type="button">Guardar
                                            compra</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Producto --}}
                <div class="col-md-4">
                    <div class="text-white bg-success p-1 text-center">
                        Datos generales
                    </div>
                    <div class="p-3 border border-3 border-success">

                    </div>
                </div>
            </div>
        </div>
    </form>

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#btn_agregar').click(function() {
                    agregarProducto();
                });

                $('#btnCancelarCompra').click(function() {
                    cancelarCompra();
                });

                $('#impuesto').val(imp + '%');
            });

            //Variables

            let cont = 0;
            let subototal = [];
            let sumas = 0;
            let igv = 0
            let total = 0

            const imp = 18;

            function cancelarCompra() {
                $('#tabla_detalle > tbody').empty();
            }


            function agregarProducto() {
                let idProducto = $('#producto_id').val();
                let nameProducto = $('#producto_id option:selected').text().trim();
                let cantidad = $('#cantidad').val();
                let precioCompra = $('#precio_compra').val();
                //console.log(nameProducto);

                if (nameProducto != '' && cantidad != '' && precioCompra != '') {

                    subototal[cont] = cantidad * precioCompra;
                    sumas += subototal[cont];
                    igv = (sumas / 100) * imp;
                    total = sumas + igv;


                    let fila = '<tr id="fila' + cont + '">' +
                        '<th>' + (cont + 1) + '</th>' +
                        '<th><input type="hidden" name="arraIdproducto[]" value="' + idProducto + '">' + nameProducto +
                        '</th>' +
                        '<th><input type="hidden" name="arraycantidad[]" value="' + cantidad + '">' + cantidad + '</th>' +
                        '<th><input type="hidden" name="arraypreciocompra[]" value="' + precioCompra + '">' + precioCompra +
                        '</th>' +
                        '<th><input type="hidden" name="arraysubtotal[]" value="' + subototal + '">' + subototal[cont] +
                        '</th>' +
                        '<th><button type="button" onclick="eliminarProducto(' + cont +
                        ')" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button></th>' +
                        '</tr>';

                    $('#tabla_detalle').append(fila);
                    actualizaTotal();
                    limpiarCampos();
                    cont++;


                    //Mostrar campos calculados
                    function actualizaTotal() {
                        $('#sumas').html(sumas);
                        $('#igv').html(igv);
                        $('#total').html(total);
                        $('#impuesto').val(igv);
                    }
                } else {
                    showModal('Debe llenar todos los campos');
                }
            }


            function eliminarProducto(indice) {
                sumas -= subototal[indice];
                igv = sumas / 100 * imp;
                total = sumas + igv;

                $('#sumas').html(sumas);
                $('#igv').html(igv);
                $('#total').html(total);
                $('#impuesto').val(igv);

                $('#fila' + indice).remove();


            }

            function limpiarCampos() {
                // let select = $('#producto_id');
                // select('val', '');
                $('#precio_compra').val('');
                $('#cantidad').val('');
                $("#producto_id").val('');
                $("#producto_id").val(0).trigger('change');
            }

            function showModal(message, icon = 'error') {
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
                    icon: icon,
                    title: message
                });
            }
        </script>
    @endpush

@endsection
