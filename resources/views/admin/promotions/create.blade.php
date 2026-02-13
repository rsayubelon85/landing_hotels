@extends('layouts.app')

@section('title', 'Nueva Promoción')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-plus-circle me-2"></i>Nueva Promoción
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('admin.promotions.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="title" class="form-label fw-bold">
                                        <i class="fas fa-heading text-primary me-2"></i>Título
                                    </label>
                                    <input
                                        type="text"
                                        class="form-control @error('title') is-invalid @enderror"
                                        id="title"
                                        name="title"
                                        value="{{ old('title') }}"
                                        placeholder="Ej: 20% OFF"
                                        required
                                    >
                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Título principal de la promoción</small>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="subtitle" class="form-label fw-bold">
                                        <i class="fas fa-align-left text-primary me-2"></i>Subtítulo
                                    </label>
                                    <input
                                        type="text"
                                        class="form-control @error('subtitle') is-invalid @enderror"
                                        id="subtitle"
                                        name="subtitle"
                                        value="{{ old('subtitle') }}"
                                        placeholder="Ej: Reserva con anticipación"
                                        required
                                    >
                                    @error('subtitle')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Descripción breve</small>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="icon" class="form-label fw-bold">
                                        <i class="fas fa-icons text-primary me-2"></i>Icono Font Awesome
                                    </label>
                                    <input
                                        type="text"
                                        class="form-control @error('icon') is-invalid @enderror"
                                        id="icon"
                                        name="icon"
                                        value="{{ old('icon', 'fas fa-percent') }}"
                                        placeholder="fas fa-percent"
                                        required
                                    >
                                    @error('icon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">
                                        Ejemplos: fas fa-percent, fas fa-utensils, fas fa-gift, fas fa-star
                                    </small>
                                    <div class="mt-2">
                                        <i class="{{ old('icon', 'fas fa-percent') }} {{ old('icon_color', 'text-primary') }} fa-3x"></i>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="icon_color" class="form-label fw-bold">
                                        <i class="fas fa-palette text-primary me-2"></i>Color del Icono
                                    </label>
                                    <select
                                        class="form-select @error('icon_color') is-invalid @enderror"
                                        id="icon_color"
                                        name="icon_color"
                                        required
                                    >
                                        <option value="text-primary" {{ old('icon_color') == 'text-primary' ? 'selected' : '' }}>Azul Primario</option>
                                        <option value="text-success" {{ old('icon_color') == 'text-success' ? 'selected' : '' }}>Verde</option>
                                        <option value="text-warning" {{ old('icon_color') == 'text-warning' ? 'selected' : '' }}>Amarillo/Anaranjado</option>
                                        <option value="text-danger" {{ old('icon_color') == 'text-danger' ? 'selected' : '' }}>Rojo</option>
                                        <option value="text-info" {{ old('icon_color') == 'text-info' ? 'selected' : '' }}>Cian</option>
                                        <option value="text-secondary" {{ old('icon_color') == 'text-secondary' ? 'selected' : '' }}>Gris</option>
                                    </select>
                                    @error('icon_color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="badge_text" class="form-label fw-bold">
                                        <i class="fas fa-badge text-primary me-2"></i>Texto del Badge (opcional)
                                    </label>
                                    <input
                                        type="text"
                                        class="form-control @error('badge_text') is-invalid @enderror"
                                        id="badge_text"
                                        name="badge_text"
                                        value="{{ old('badge_text') }}"
                                        placeholder="AHORRA AHORA"
                                    >
                                    @error('badge_text')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="badge_color" class="form-label fw-bold">
                                        <i class="fas fa-palette text-primary me-2"></i>Color del Badge
                                    </label>
                                    <select
                                        class="form-select @error('badge_color') is-invalid @enderror"
                                        id="badge_color"
                                        name="badge_color"
                                    >
                                        <option value="bg-primary" {{ old('badge_color') == 'bg-primary' ? 'selected' : '' }}>Azul Primario</option>
                                        <option value="bg-success" {{ old('badge_color') == 'bg-success' ? 'selected' : '' }}>Verde</option>
                                        <option value="bg-warning" {{ old('badge_color') == 'bg-warning' ? 'selected' : '' }}>Amarillo</option>
                                        <option value="bg-danger" {{ old('badge_color') == 'bg-danger' ? 'selected' : '' }}>Rojo</option>
                                        <option value="bg-info" {{ old('badge_color') == 'bg-info' ? 'selected' : '' }}>Cian</option>
                                        <option value="bg-secondary" {{ old('badge_color') == 'bg-secondary' ? 'selected' : '' }}>Gris</option>
                                    </select>
                                    @error('badge_color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="button_text" class="form-label fw-bold">
                                        <i class="fas fa-mouse-pointer text-primary me-2"></i>Texto del Botón (opcional)
                                    </label>
                                    <input
                                        type="text"
                                        class="form-control @error('button_text') is-invalid @enderror"
                                        id="button_text"
                                        name="button_text"
                                        value="{{ old('button_text') }}"
                                        placeholder="Ver Ofertas"
                                    >
                                    @error('button_text')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="button_url" class="form-label fw-bold">
                                        <i class="fas fa-link text-primary me-2"></i>URL del Botón (opcional)
                                    </label>
                                    <input
                                        type="url"
                                        class="form-control @error('button_url') is-invalid @enderror"
                                        id="button_url"
                                        name="button_url"
                                        value="{{ old('button_url') }}"
                                        placeholder="https://ejemplo.com/ofertas"
                                    >
                                    @error('button_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="order" class="form-label fw-bold">
                                        <i class="fas fa-sort-numeric-up text-primary me-2"></i>Orden
                                    </label>
                                    <input
                                        type="number"
                                        class="form-control @error('order') is-invalid @enderror"
                                        id="order"
                                        name="order"
                                        value="{{ old('order', 0) }}"
                                        min="0"
                                    >
                                    @error('order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Posición en la que aparecerá (0 = primera)</small>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="is_active" class="form-label fw-bold">
                                        <i class="fas fa-toggle-on text-primary me-2"></i>Estado
                                    </label>
                                    <select
                                        class="form-select @error('is_active') is-invalid @enderror"
                                        id="is_active"
                                        name="is_active"
                                        required
                                    >
                                        <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>Activa</option>
                                        <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>Inactiva</option>
                                    </select>
                                    @error('is_active')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                                <a href="{{ route('admin.promotions.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Volver
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg px-5">
                                    <i class="fas fa-save me-2"></i>Crear Promoción
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
