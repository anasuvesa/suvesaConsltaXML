@extends('template')
@section('title', '- Comprobantes')

@push('css')
    <style>

    </style>
@endpush

@section('content')

    <section class="page-section">
        <div class="container mt-5">

            <div class="card">
                <div class="card-header">
                    <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Consulta
                        Comprobantes
                        Electronicos</h2>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Clave</label>
                        <div class="col-sm-4">
                            <input type="text" readonly class="form-control" value="{{ $comprobantes->clave }}">
                        </div>

                        <label class="col-sm-2 col-form-label">Consecutivo</label>
                        <div class="col-sm-4">
                            <input type="text" readonly class="form-control" value="{{ $comprobantes->consecutivo }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Emisor</label>
                        <div class="col-sm-4">
                            <input type="text" readonly class="form-control" value="{{ $comprobantes->nombre }}">
                        </div>

                        <label class="col-sm-2 col-form-label">Estado</label>
                        <div class="col-sm-4">
                            <input type="text" readonly class="form-control" value="{{ $comprobantes->estado }}">
                        </div>
                    </div>

                    <hr>

                    <div class="form-group row">
                        <div class="col-sm-4">
                            {{-- <a class= "btn btn-lg btn-primary" id="descarga" href="{{ $comprobantes->url_firmado }}"
                                target="_blank">XML Firmado</a> --}}

                                <a class="btn btn-lg btn-primary" id="descarga" href="{{ route('comprobantes.descargar', ['clave' => $comprobantes->clave, 'tipo' => 'firmado']) }}" target="_blank">XML Firmado</a>
                        </div>
                        <div class="col-sm-4">
                            {{-- <a class= "btn btn-lg btn-primary" id="descarga" href="{{ $comprobantes->url_respuesta }}"
                                target="_blank">Respuesta Hacienda</a> --}}
                                <a class="btn btn-lg btn-primary" id="descarga" href="{{ route('comprobantes.descargar', ['clave' => $comprobantes->clave, 'tipo' => 'respuesta']) }}" target="_blank">Respuesta Hacienda</a>
                        </div>
                        <div class="col-sm-4">
                            {{-- <a class= "btn btn-lg btn-primary" id="descarga" href="{{ $comprobantes->url_pdf }}"
                                target="_blank">PDF</a> --}}
                                <a class="btn btn-lg btn-primary" id="descarga" href="{{ route('comprobantes.descargar', ['clave' => $comprobantes->clave, 'tipo' => 'pdf']) }}" target="_blank">PDF</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection

@push('js')

<script>
    document.querySelectorAll('a#descarga').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            const url = this.getAttribute('href');

            // Mensaje de confirmación previo (opcional)
            if (confirm("¿Deseás descargar este archivo?")) {
                // Mostrar notificación (con Bootstrap 5, SweetAlert, o simple alert)
                alert("Tu descarga comenzará en breve.");

                // Redirige a la URL de descarga
                window.location.href = url;
            }
        });
    });
</script>
@endpush
