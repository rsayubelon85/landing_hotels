@extends('layouts.app')

@section('title', 'Configuración del Header')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-cog me-2"></i>Configuración del Header Principal
                        </h5>
                    </div>
                    <div class="card-body p-4">

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('admin.header.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!-- Columna izquierda: Texto y botón -->
                                <div class="col-md-6 mb-4">
                                    <div class="card h-100">
                                        <div class="card-header bg-light">
                                            <h6 class="mb-0 fw-bold">
                                                <i class="fas fa-heading text-primary me-2"></i>Contenido del Header
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="title" class="form-label fw-bold">
                                                    <i class="fas fa-font me-2 text-primary"></i>Título Principal
                                                </label>
                                                <input
                                                    type="text"
                                                    class="form-control @error('title') is-invalid @enderror"
                                                    id="title"
                                                    name="title"
                                                    value="{{ old('title', $config->title) }}"
                                                    placeholder="Ej: Descubre los Mejores Hoteles en Cuba"
                                                >
                                                @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted">Texto grande que aparece en el header</small>
                                            </div>

                                            <div class="mb-3">
                                                <label for="subtitle" class="form-label fw-bold">
                                                    <i class="fas fa-align-left text-primary me-2"></i>Subtítulo
                                                </label>
                                                <textarea
                                                    class="form-control @error('subtitle') is-invalid @enderror"
                                                    id="subtitle"
                                                    name="subtitle"
                                                    rows="3"
                                                    placeholder="Ej: Alojamiento de lujo en los destinos más hermosos de la isla"
                                                >{{ old('subtitle', $config->subtitle) }}</textarea>
                                                @error('subtitle')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted">Descripción debajo del título</small>
                                            </div>

                                            <div class="mb-3">
                                                <label for="button_text" class="form-label fw-bold">
                                                    <i class="fas fa-mouse-pointer text-primary me-2"></i>Texto del Botón
                                                </label>
                                                <input
                                                    type="text"
                                                    class="form-control @error('button_text') is-invalid @enderror"
                                                    id="button_text"
                                                    name="button_text"
                                                    value="{{ old('button_text', $config->button_text) }}"
                                                    placeholder="Ej: Explorar Hoteles"
                                                >
                                                @error('button_text')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted">Texto que aparece en el botón del header</small>
                                            </div>

                                            <div class="mb-3">
                                                <label for="button_url" class="form-label fw-bold">
                                                    <i class="fas fa-link text-primary me-2"></i>URL del Botón
                                                </label>
                                                <input
                                                    type="url"
                                                    class="form-control @error('button_url') is-invalid @enderror"
                                                    id="button_url"
                                                    name="button_url"
                                                    value="{{ old('button_url', $config->button_url) }}"
                                                    placeholder="Ej: #hotels"
                                                >
                                                @error('button_url')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted">Enlace donde redirige el botón (ej: #hotels)</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Columna derecha: Imagen de fondo -->
                                <div class="col-md-6 mb-4">
                                    <div class="card h-100">
                                        <div class="card-header bg-light">
                                            <h6 class="mb-0 fw-bold">
                                                <i class="fas fa-image text-primary me-2"></i>Imagen de Fondo
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3 text-center">
                                                <label class="form-label fw-bold d-block mb-3">
                                                    <i class="fas fa-file-image text-primary me-2"></i>Vista Previa
                                                </label>

                                                @if($config->background_image_url)
                                                    <img
                                                        src="{{ $config->background_image_url }}"
                                                        id="preview-image"
                                                        class="img-fluid rounded shadow-sm mb-3"
                                                        style="max-height: 300px; width: 100%; object-fit: cover;"
                                                        alt="Imagen de fondo actual"
                                                    >
                                                @else
                                                    <div
                                                        id="preview-image"
                                                        class="border rounded bg-light d-flex align-items-center justify-content-center mb-3"
                                                        style="height: 300px; width: 100%;"
                                                    >
                                                        <p class="text-muted mb-0">
                                                            <i class="fas fa-image fa-3x"></i><br>
                                                            Sin imagen de fondo
                                                        </p>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="mb-3">
                                                <label for="background_image" class="form-label fw-bold">
                                                    <i class="fas fa-upload text-primary me-2"></i>Cargar Nueva Imagen
                                                </label>
                                                <input
                                                    type="file"
                                                    class="form-control @error('background_image') is-invalid @enderror"
                                                    id="background_image"
                                                    name="background_image"
                                                    accept="image/*"
                                                >
                                                @error('background_image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted">
                                                    Formatos: JPG, PNG, GIF<br>
                                                    Recomendado: 1920x500px para mejor visualización
                                                </small>
                                            </div>

                                            <div class="alert alert-info">
                                                <i class="fas fa-info-circle me-2"></i>
                                                <strong>Nota:</strong> La imagen se mostrará con un efecto de oscurecimiento
                                                para mejorar la legibilidad del texto.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                                <a href="{{ route('home') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Volver al Inicio
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg px-5">
                                    <i class="fas fa-save me-2"></i>Guardar Configuración
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Vista previa de la imagen seleccionada
        document.getElementById('background_image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('preview-image');

            if (file) {
                const reader = new FileReader();

                reader.onload = function(event) {
                    if (preview.tagName === 'IMG') {
                        preview.src = event.target.result;
                    } else {
                        preview.innerHTML = `<img src="${event.target.result}" class="img-fluid rounded shadow-sm" style="max-height: 300px; width: 100%; object-fit: cover;">`;
                    }
                };

                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush
