@extends('layouts.app')

@section('title', 'Crear Nuevo Hotel')

@push('styles')
    <style>
        .amenity-item {
            transition: all 0.3s ease;
            border: 1px solid #dee2e6;
        }

        .amenity-item:hover {
            border-color: #0d6efd;
            background-color: #e7f3ff !important;
        }

        .input-group-text {
            min-width: 40px;
            justify-content: center;
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
    </style>
@endpush

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-success">
                        <h5 class="mb-0">
                            <i class="fas fa-plus-circle me-2"></i>Crear Nuevo Hotel
                        </h5>
                    </div>
                    <div class="card-body p-4">

                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>¡Error!</strong> Por favor corrige los siguientes campos:
                                <ul class="mb-0 mt-2">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('admin.hotels.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <!-- Columna izquierda: Información básica -->
                                <div class="col-md-6 mb-4">
                                    <div class="card h-100">
                                        <div class="card-header bg-light">
                                            <h6 class="mb-0 fw-bold">
                                                <i class="fas fa-info-circle text-primary me-2"></i>Información Básica
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="name" class="form-label fw-bold">
                                                    <i class="fas fa-hotel text-primary me-2"></i>Nombre del Hotel *
                                                </label>
                                                <input
                                                    type="text"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    id="name"
                                                    name="name"
                                                    value="{{ old('name') }}"
                                                    required
                                                    autofocus
                                                >
                                                @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="description" class="form-label fw-bold">
                                                    <i class="fas fa-align-left text-primary me-2"></i>Descripción
                                                </label>
                                                <textarea
                                                    class="form-control @error('description') is-invalid @enderror"
                                                    id="description"
                                                    name="description"
                                                    rows="4"
                                                    placeholder="Describe las características del hotel..."
                                                >{{ old('description') }}</textarea>
                                                @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="location" class="form-label fw-bold">
                                                    <i class="fas fa-map-marker-alt text-primary me-2"></i>Ubicación
                                                </label>
                                                <input
                                                    type="text"
                                                    class="form-control @error('location') is-invalid @enderror"
                                                    id="location"
                                                    name="location"
                                                    value="{{ old('location') }}"
                                                    placeholder="Ej: Varadero, Cuba"
                                                >
                                                @error('location')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Columna derecha: Detalles y precio -->
                                <div class="col-md-6 mb-4">
                                    <div class="card h-100">
                                        <div class="card-header bg-light">
                                            <h6 class="mb-0 fw-bold">
                                                <i class="fas fa-dollar-sign text-primary me-2"></i>Detalles y Precio
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="price" class="form-label fw-bold">
                                                    <i class="fas fa-tag text-primary me-2"></i>Precio por Noche ($) *
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input
                                                        type="number"
                                                        step="0.01"
                                                        class="form-control @error('price') is-invalid @enderror"
                                                        id="price"
                                                        name="price"
                                                        value="{{ old('price') }}"
                                                        required
                                                    >
                                                </div>
                                                @error('price')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="rating" class="form-label fw-bold">
                                                    <i class="fas fa-star text-primary me-2"></i>Rating Inicial (0-5)
                                                </label>
                                                <input
                                                    type="number"
                                                    step="0.1"
                                                    min="0"
                                                    max="5"
                                                    class="form-control @error('rating') is-invalid @enderror"
                                                    id="rating"
                                                    name="rating"
                                                    value="{{ old('rating', 0) }}"
                                                >
                                                @error('rating')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted">Puedes actualizarlo después</small>
                                            </div>

                                            <div class="mb-3">
                                                <label for="image_path" class="form-label">Imagen del Hotel</label>
                                                <input type="file" class="form-control @error('image_path') is-invalid @enderror"
                                                       id="image_path" name="image_path" accept="image/*">
                                                <div class="form-text">Formatos aceptados: JPG, PNG, GIF (máx. 2MB)</div>
                                                @error('image_path')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3 form-check">
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    id="is_active"
                                                    name="is_active"
                                                    value="1"
                                                    checked
                                                >
                                                <label class="form-check-label fw-bold" for="is_active">
                                                    <i class="fas fa-toggle-on text-success me-2"></i>Hotel Activo
                                                </label>
                                                <br>
                                                <small class="text-muted">Mostrar en la landing page</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Servicios/Amenities -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0 fw-bold">
                                                <i class="fas fa-concierge-bell text-primary me-2"></i>Servicios y Amenities
                                            </h6>
                                            <small class="text-muted">
                                                <i class="fas fa-info-circle me-1"></i>
                                                Agrega los servicios que ofrece el hotel
                                            </small>
                                        </div>
                                        <div class="card-body">
                                            <div id="amenities-container">
                                                @if(old('amenities'))
                                                    @foreach(old('amenities') as $index => $amenity)
                                                        <div class="amenity-item mb-2 p-2 bg-light rounded border" data-index="{{ $index }}">
                                                            <div class="input-group">
                                                                <span class="input-group-text bg-white">
                                                                    <i class="fas fa-check-circle text-success"></i>
                                                                </span>
                                                                <input
                                                                    type="text"
                                                                    class="form-control amenity-input @error('amenities.' . $index) is-invalid @enderror"
                                                                    name="amenities[]"
                                                                    value="{{ $amenity }}"
                                                                    placeholder="Ej: Piscina, WiFi, Restaurante..."
                                                                    required
                                                                >
                                                                <button type="button" class="btn btn-danger btn-sm remove-amenity" title="Eliminar">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </div>
                                                            @error('amenities.' . $index)
                                                            <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="amenity-item mb-2 p-2 bg-light rounded border" data-index="0">
                                                        <div class="input-group">
                                                            <span class="input-group-text bg-white">
                                                                <i class="fas fa-check-circle text-success"></i>
                                                            </span>
                                                            <input
                                                                type="text"
                                                                class="form-control amenity-input"
                                                                name="amenities[]"
                                                                placeholder="Ej: Piscina, WiFi, Restaurante..."
                                                                required
                                                            >
                                                            <button type="button" class="btn btn-danger btn-sm remove-amenity" title="Eliminar">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                            <button type="button" class="btn btn-sm btn-success mt-2" id="add-amenity">
                                                <i class="fas fa-plus-circle me-1"></i> Agregar Servicio
                                            </button>

                                            <div class="alert alert-info mt-3 mb-0">
                                                <i class="fas fa-lightbulb me-2"></i>
                                                <strong>Sugerencias:</strong> Piscina, WiFi, Restaurante, Bar, Estacionamiento, Aire Acondicionado
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Opción de Reserva Directa -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header bg-light">
                                            <h6 class="mb-0 fw-bold">
                                                <i class="fas fa-ticket-alt text-primary me-2"></i>Reserva Directa
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3 form-check">
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    id="has_direct_booking"
                                                    name="has_direct_booking"
                                                    value="1"
                                                    {{ old('has_direct_booking') ? 'checked' : '' }}
                                                >
                                                <label class="form-check-label fw-bold" for="has_direct_booking">
                                                    <i class="fas fa-toggle-on text-success me-2"></i>Este hotel tiene reserva directa
                                                </label>
                                                <br>
                                                <small class="text-muted">Se mostrará un botón de reserva en la landing page</small>
                                            </div>

                                            <div id="booking-fields" style="{{ old('has_direct_booking') ? '' : 'display:none;' }}">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="property_number" class="form-label fw-bold">
                                                            <i class="fas fa-hashtag text-primary me-2"></i>Número de Propiedad *
                                                        </label>
                                                        <input
                                                            type="text"
                                                            class="form-control @error('property_number') is-invalid @enderror"
                                                            id="property_number"
                                                            name="property_number"
                                                            value="{{ old('property_number') }}"
                                                            placeholder="Ej: HT 52896"
                                                        >
                                                        @error('property_number')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label for="refpoint" class="form-label fw-bold">
                                                            <i class="fas fa-map-marker-alt text-primary me-2"></i>Punto de Referencia
                                                        </label>
                                                        <input
                                                            type="text"
                                                            class="form-control @error('refpoint') is-invalid @enderror"
                                                            id="refpoint"
                                                            name="refpoint"
                                                            value="{{ old('refpoint') }}"
                                                            placeholder="Ej: Varadero"
                                                        >
                                                        @error('refpoint')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label for="iata_code" class="form-label fw-bold">
                                                            <i class="fas fa-plane text-primary me-2"></i>Código IATA
                                                        </label>
                                                        <input
                                                            type="text"
                                                            class="form-control @error('iata_code') is-invalid @enderror"
                                                            id="iata_code"
                                                            name="iata_code"
                                                            value="{{ old('iata_code', 'VRA') }}"
                                                            placeholder="Ej: VRA"
                                                            maxlength="3"
                                                        >
                                                        @error('iata_code')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label for="booking_url" class="form-label fw-bold">
                                                            <i class="fas fa-link text-primary me-2"></i>URL Personalizada
                                                        </label>
                                                        <input
                                                            type="url"
                                                            class="form-control @error('booking_url') is-invalid @enderror"
                                                            id="booking_url"
                                                            name="booking_url"
                                                            value="{{ old('booking_url') }}"
                                                            placeholder="https://ejemplo.com"
                                                        >
                                                        @error('booking_url')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                                <a href="{{ route('admin.hotels.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Volver a la Lista
                                </a>
                                <div>
                                    <button type="reset" class="btn btn-outline-secondary me-2">
                                        <i class="fas fa-undo me-2"></i>Limpiar
                                    </button>
                                    <button type="submit" class="btn btn-success btn-lg px-4">
                                        <i class="fas fa-save me-2"></i>Crear Hotel
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('✅ DOM cargado - Inicializando scripts...');

        // ========== 1. TOGGLE BOOKING FIELDS ==========
        const checkbox = document.getElementById('has_direct_booking');
        const bookingFields = document.getElementById('booking-fields');

        if (checkbox && bookingFields) {
            console.log('✅ Checkbox y booking fields encontrados');

            function toggleBookingFields() {
                if (checkbox.checked) {
                    bookingFields.style.display = 'block';
                    bookingFields.style.opacity = '0';
                    setTimeout(() => {
                        bookingFields.style.transition = 'opacity 0.3s ease';
                        bookingFields.style.opacity = '1';
                    }, 10);
                } else {
                    bookingFields.style.opacity = '0';
                    setTimeout(() => {
                        bookingFields.style.display = 'none';
                    }, 300);
                }
            }

            checkbox.addEventListener('change', toggleBookingFields);
            toggleBookingFields();
        }

        // ========== 2. MANEJO DE AMENITIES ==========
        let amenityCounter = {{ old('amenities') ? count(old('amenities')) : 1 }};
        console.log('🔢 Contador inicial de amenities:', amenityCounter);

        const addButton = document.getElementById('add-amenity');
        if (addButton) {
            addButton.addEventListener('click', function() {
                addAmenity();
            });
        }

        function addAmenity(value = '') {
            const container = document.getElementById('amenities-container');
            if (!container) return;

            const div = document.createElement('div');
            div.className = 'amenity-item mb-2 p-2 bg-light rounded border';
            div.setAttribute('data-index', amenityCounter);
            div.innerHTML = `
                <div class="input-group">
                    <span class="input-group-text bg-white">
                        <i class="fas fa-check-circle text-success"></i>
                    </span>
                    <input
                        type="text"
                        class="form-control amenity-input"
                        name="amenities[]"
                        value="${value.replace(/"/g, '&quot;')}"
                        placeholder="Ej: Piscina, WiFi..."
                        required
                    >
                    <button type="button" class="btn btn-danger btn-sm remove-amenity" title="Eliminar">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            `;

            container.appendChild(div);
            amenityCounter++;
            setTimeout(() => div.querySelector('input').focus(), 100);
        }

        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-amenity')) {
                const button = e.target.closest('.remove-amenity');
                const amenityItem = button.closest('.amenity-item');
                if (!amenityItem) return;

                const items = document.querySelectorAll('.amenity-item');
                if (items.length === 1) {
                    amenityItem.querySelector('.amenity-input').value = '';
                    alert('⚠️ Debes tener al menos un servicio');
                } else if (confirm('¿Eliminar este servicio?')) {
                    amenityItem.remove();
                }
            }
        });
    });
</script>


