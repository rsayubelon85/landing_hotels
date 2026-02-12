@extends('layouts.app')

@section('title', 'Administrar Hoteles')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Gestión de Hoteles</h5>
                        <a href="{{ route('admin.hotels.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Nuevo Hotel
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Imagen</th>
                                    <th>Nombre</th>
                                    <th>Ubicación</th>
                                    <th>Precio</th>
                                    <th>Rating</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($hotels as $hotel)
                                    <tr>
                                        <td>
                                            <div class="hotel-image-container">
                                                @if($hotel->image_path)
                                                    @if(Str::startsWith($hotel->image_path, 'http'))
                                                        <img src="{{ $hotel->image_path }}" alt="{{ $hotel->name }}" class="hotel-image">
                                                    @else
                                                        <img src="{{ asset('storage/' . $hotel->image_path) }}" alt="{{ $hotel->name }}" class="hotel-image">
                                                    @endif
                                                @else
                                                    <div class="no-image-placeholder">
                                                        <i class="fas fa-hotel text-muted"></i>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ $hotel->name }}</td>
                                        <td>{{ $hotel->location }}</td>
                                        <td>${{ number_format($hotel->price, 2) }}</td>
                                        <td>
                                            <span class="badge bg-warning">
                                                <i class="fas fa-star"></i> {{ $hotel->rating }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($hotel->is_active)
                                                <span class="badge bg-success">Activo</span>
                                            @else
                                                <span class="badge bg-secondary">Inactivo</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.hotels.edit', $hotel) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.hotels.destroy', $hotel) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No hay hoteles registrados</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
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
@endsection

@push('scripts')
    <script>
        // SweetAlert para confirmaciones más bonitas
        document.querySelectorAll('form[method="DELETE"]').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                if (confirm('¿Estás seguro de eliminar este hotel?')) {
                    this.submit();
                }
            });
        });
    </script>
@endpush
