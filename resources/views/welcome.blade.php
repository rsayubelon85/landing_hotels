@extends('layouts.app')

@section('title', 'Hotéis en Cuba - Cuba E-commerce 365')

@php
    $header = $header ?? null;
@endphp

@section('styles')
    <style>
        .hero-section {
            background-size: cover;
            background-position: center;
            height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            position: relative;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7));
        }

        .hotel-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 10px;
            overflow: hidden;
        }

        .hotel-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        /* Gradient Background for Promotions */
        .bg-gradient-promo {
            background: linear-gradient(135deg, #0d6efd 0%, #0d6efd 100%);
            position: relative;
            overflow: hidden;
        }

        .bg-gradient-promo::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.3;
        }

        /* Promo Card */
        .promo-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 2.5rem;
            text-align: center;
            transition: all 0.4s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            position: relative;
            overflow: hidden;
            border: 2px solid transparent;
        }

        .promo-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #0d6efd, #0d6efd);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }

        .promo-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
            border-color: #667eea;
        }

        .promo-card:hover::before {
            transform: scaleX(1);
        }

        .promo-card .promo-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(102, 126, 234, 0.1);
            border-radius: 50%;
            transition: all 0.4s ease;
        }

        .promo-card:hover .promo-icon {
            background: rgba(102, 126, 234, 0.2);
            transform: scale(1.1);
        }

        .promo-card h4 {
            color: #2c3e50;
            font-size: 1.5rem;
            transition: color 0.4s ease;
        }

        .promo-card:hover h4 {
            color: #667eea;
        }

        .promo-card p {
            color: #6c757d;
            line-height: 1.6;
        }

        .promo-badge {
            margin-top: 1.5rem;
        }

        .promo-badge .badge {
            font-size: 0.9rem;
            font-weight: 600;
            border-radius: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        /* CTA Box */
        .cta-box {
            background: rgba(255, 255, 255, 0.98);
            border: 3px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .cta-box h3 {
            color: #2c3e50;
            font-size: 2rem;
        }

        .cta-box p {
            color: #6c757d;
            font-size: 1.2rem;
        }

        .cta-box .btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            font-size: 1.2rem;
            padding: 1rem 3rem;
            transition: all 0.4s ease;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        }

        .cta-box .btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.6);
            background: linear-gradient(135deg, #5568d3 0%, #653f8a 100%);
        }

        /* Search Section - SIMPLE */
        .search-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 2.5rem 0;
            position: relative;
        }

        .search-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            opacity: 0.3;
        }

        .search-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.12);
            padding: 2rem;
            position: relative;
            z-index: 10;
        }

        .search-title {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .search-title h3 {
            font-weight: 700;
            color: #2c3e50;
            font-size: 1.6rem;
        }

        .search-title p {
            color: #6c757d;
            margin-bottom: 0;
            font-size: 0.95rem;
        }

        /* Search Form - SIMPLE */
        .search-form {
            position: relative;
        }

        .search-form .input-group {
            border: 2px solid #dee2e6;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s ease;
            background: white;
        }

        .search-form .input-group:focus-within {
            border-color: #0d6efd;
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.2);
        }

        .search-form .input-group-text {
            background: #f8f9fa;
            border: none;
            padding: 1rem 1.2rem;
            color: #6c757d;
            font-size: 1.1rem;
        }

        .search-form .form-control {
            border: none;
            border-left: 1px solid #dee2e6;
            padding: 1rem 1.2rem;
            font-size: 1rem;
            height: 100%;
        }

        .search-form .form-control:focus {
            box-shadow: none;
            border-color: transparent;
        }

        .search-form .btn {
            border: none;
            padding: 1rem 1.8rem;
            font-weight: 600;
            font-size: 1rem;
            border-radius: 0;
            transition: all 0.3s ease;
        }

        .search-form .btn-primary {
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
        }

        .search-form .btn-primary:hover {
            background: linear-gradient(135deg, #0b5ed7 0%, #0a58ca 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.4);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .search-section {
                padding: 1.5rem 0;
            }

            .search-container {
                padding: 1.5rem;
                margin: 0 15px;
            }

            .search-title h3 {
                font-size: 1.4rem;
            }

            .search-title p {
                font-size: 0.9rem;
            }

            .search-form .form-control {
                font-size: 0.95rem;
                padding: 0.8rem 1rem;
            }

            .search-form .btn {
                padding: 0.8rem 1.5rem;
                font-size: 0.95rem;
            }
        }

        @media (max-width: 576px) {
            .search-container {
                margin: 0 10px;
            }

            .search-form .input-group {
                flex-direction: column;
            }

            .search-form .input-group-text,
            .search-form .form-control,
            .search-form .btn {
                border-radius: 8px !important;
                margin-bottom: 0.5rem;
            }

            .search-form .input-group > :last-child {
                margin-bottom: 0;
            }
        }
        /* Botón de Reserva */
        .btn-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
            background: linear-gradient(135deg, #218838 0%, #1ba87e 100%);
        }

        .btn-success i {
            font-size: 1.1rem;
        }

        /* Badge de Reserva */
        .badge-reservation {
            position: absolute;
            top: 10px;
            right: 10px;
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(40, 167, 69, 0.3);
        }

        /* Efecto hover en card con reserva */
        .hotel-card.has-reservation:hover {
            border-top: 4px solid #28a745;
        }
    </style>
@endsection

@section('content')
    <!-- Header Section -->
    <section class="hero-section" style="background-image: url('{{ $header->background_image_url ?? asset('images/default-header.jpg') }}')">
        <div class="container position-relative z-1">
            <h1 class="display-3 fw-bold text-white mb-3">
                {{ $header->title ?? 'Descubre los Mejores Hoteles en Cuba' }}
            </h1>
            <p class="lead text-white mb-4">
                {{ $header->subtitle ?? 'Encuentra tu alojamiento perfecto en la isla del caribe' }}
            </p>
            @if($header && $header->button_text)
                <a href="{{ $header->button_url ?? '#' }}" class="btn btn-primary btn-lg px-5 py-3 fw-bold">
                    {{ $header->button_text }}
                </a>
            @endif
        </div>
    </section>

    <!-- Promotions Section - DINÁMICA -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center mb-5">
                    <h2 class="fw-bold display-5 mb-3">✨ Ofertas Especiales ✨</h2>
                    <p class="text-muted lead">Ahorra en tu próxima estadía en Cuba</p>
                </div>
            </div>

            <div class="row g-4">
                @forelse($promotions as $promotion)
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body text-center p-4">
                                <div class="mb-3">
                                    <i class="{{ $promotion->icon }} {{ $promotion->icon_color }} fa-2x"></i>
                                </div>
                                <h5 class="fw-bold mb-2">{{ $promotion->title }}</h5>
                                <p class="text-muted small">{{ $promotion->subtitle }}</p>

                                @if($promotion->badge_text)
                                    <span class="badge {{ $promotion->badge_color }} mt-2">
                                    {{ $promotion->badge_text }}
                                </span>
                                @endif

                                @if($promotion->button_text && $promotion->button_url)
                                    <div class="mt-3">
                                        <a href="{{ $promotion->button_url }}" class="btn btn-sm btn-outline-primary">
                                            {{ $promotion->button_text }}
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                        <h4 class="text-muted mb-2">No hay promociones disponibles</h4>
                        <p class="text-muted">Próximamente nuevas ofertas</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Search Section - SIMPLE -->
    <section class="search-section">
        <div class="container">
            <div class="search-container">
                <div class="search-title">
                    <h3><i class="fas fa-search me-2"></i>Busca tu Hotel</h3>
                    <p>Encuentra hoteles por nombre o ubicación</p>
                </div>

                <form method="GET" action="{{ route('home') }}" class="search-form">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>
                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Ej: Hotel Nacional, Varadero..."
                            value="{{ request('search') }}"
                            autocomplete="off"
                        >
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search me-1"></i>Buscar
                        </button>
                        @if(request('search'))
                            <a href="{{ route('home') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-1"></i>Limpiar
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Hotels Section -->
    <section id="hotels" class="py-5 bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="fw-bold">Hoteles Destacados</h2>
                    <p class="text-muted">Descubre nuestra selección de hoteles de lujo</p>
                </div>
            </div>

            @if(request('search'))
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Resultados para:</strong> "{{ request('search') }}"
                            @if($hotels->total() > 0)
                                <span class="badge bg-primary ms-2">{{ $hotels->total() }} hotel{{ $hotels->total() != 1 ? 'es' : '' }}</span>
                            @else
                                <span class="text-muted ms-2">(No se encontraron resultados)</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                @forelse($hotels as $hotel)
                    <div class="col-md-4 mb-4">
                        <div class="card hotel-card h-100">
                            @if($hotel->has_direct_booking)
                                <span class="position-absolute top-0 end-0 bg-success text-white py-1 px-2 rounded-start mt-2 me-2 fw-bold small">
                                    <i class="fas fa-bolt me-1"></i>Reserva Directa
                                </span>
                            @endif
                            @if($hotel->image_path)
                                @if(Str::startsWith($hotel->image_path, 'http'))
                                    <img src="{{ $hotel->image_path }}" alt="{{ $hotel->name }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('storage/' . $hotel->image_path) }}" alt="{{ $hotel->name }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                                @endif
                            @else
                                <div class="card-img-top w-100 h-100 d-flex align-items-center justify-content-center bg-light" style="height: 200px;">
                                    <i class="fas fa-hotel text-muted" style="font-size: 4rem;"></i>
                                </div>
                            @endif
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="card-title fw-bold">{{ $hotel->name }}</h5>
                                    <span class="badge bg-warning text-dark">
                                        <i class="fas fa-star"></i> {{ number_format($hotel->rating, 1) }}
                                    </span>
                                </div>
                                <p class="card-text text-muted small">
                                    <i class="fas fa-map-marker-alt me-2"></i>{{ $hotel->location }}
                                </p>
                                <p class="card-text">{{ Str::limit($hotel->description, 120) }}</p>

                                @if($hotel->amenities)
                                    <ul class="list-unstyled small mb-3">
                                        @foreach(array_slice($hotel->amenities, 0, 3) as $amenity)
                                            <li><i class="fas fa-check-circle text-success me-2"></i>{{ $amenity }}</li>
                                        @endforeach
                                    </ul>
                                @endif

                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold fs-4 text-primary">${{ number_format($hotel->price, 2) }}</span>

                                    @if($hotel->has_direct_booking && $hotel->booking_link)
                                        <a href="{{ $hotel->booking_link }}" target="_blank" class="btn btn-success btn-sm" title="Reservar en Cuba Travel">
                                            <i class="fas fa-ticket-alt me-1"></i>Reservar Ahora
                                        </a>
                                    @else
                                        <a href="#" class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-info-circle me-1"></i>Ver Detalles
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="fas fa-hotel fa-3x text-muted mb-3"></i>
                        <h4 class="text-muted mb-2">No se encontraron hoteles</h4>
                        <p class="text-muted">Intenta con otros criterios de búsqueda</p>
                        <a href="{{ route('home') }}" class="btn btn-primary mt-3">
                            <i class="fas fa-redo me-1"></i>Ver todos los hoteles
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Paginación -->
            <div class="row mt-4">
                <div class="col-12 d-flex justify-content-center">
                    <nav aria-label="Page navigation">
                        <ul class="pagination mb-0">
                            {{-- Flecha Anterior --}}
                            @if($hotels->onFirstPage())
                                <li class="page-item disabled">
                        <span class="page-link">
                            <i class="fas fa-chevron-left me-1"></i>Anterior
                        </span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $hotels->previousPageUrl() }}" rel="prev">
                                        <i class="fas fa-chevron-left me-1"></i>Anterior
                                    </a>
                                </li>
                            @endif

                            {{-- Números de página --}}
                            @foreach($hotels->links()->elements[0] as $page => $url)
                                @if($page == $hotels->currentPage())
                                    <li class="page-item active">
                                        <span class="page-link">{{ $page }}</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach

                            {{-- Flecha Siguiente --}}
                            @if($hotels->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $hotels->nextPageUrl() }}" rel="next">
                                        Siguiente<i class="fas fa-chevron-right ms-1"></i>
                                    </a>
                                </li>
                            @else
                                <li class="page-item disabled">
                        <span class="page-link">
                            Siguiente<i class="fas fa-chevron-right ms-1"></i>
                        </span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
@endsection
