@extends('layouts.app')

@section('title', 'Gestión de Promociones')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-tags me-2"></i>Promociones
                        </h5>
                        <a href="{{ route('admin.promotions.create') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-plus me-1"></i>Nueva Promoción
                        </a>
                    </div>
                    <div class="card-body p-0">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                <tr>
                                    <th style="width: 50px;">Orden</th>
                                    <th>Icono</th>
                                    <th>Título</th>
                                    <th>Subtítulo</th>
                                    <th>Badge</th>
                                    <th>Estado</th>
                                    <th style="width: 150px;">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($promotions as $promotion)
                                    <tr>
                                        <td class="fw-bold">{{ $promotion->order }}</td>
                                        <td>
                                            <i class="{{ $promotion->icon }} {{ $promotion->icon_color }} fa-2x"></i>
                                        </td>
                                        <td class="fw-bold">{{ $promotion->title }}</td>
                                        <td>{{ $promotion->subtitle }}</td>
                                        <td>
                                            @if($promotion->badge_text)
                                                <span class="badge {{ $promotion->badge_color }}">
                                                        {{ $promotion->badge_text }}
                                                    </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($promotion->is_active)
                                                <span class="badge bg-success">Activa</span>
                                            @else
                                                <span class="badge bg-secondary">Inactiva</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.promotions.edit', $promotion) }}"
                                               class="btn btn-sm btn-primary" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.promotions.destroy', $promotion) }}"
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('¿Estás seguro de eliminar esta promoción?')"
                                                        title="Eliminar">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                                            <p class="text-muted">No hay promociones registradas</p>
                                            <a href="{{ route('admin.promotions.create') }}" class="btn btn-primary">
                                                <i class="fas fa-plus me-1"></i>Crear Primera Promoción
                                            </a>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
