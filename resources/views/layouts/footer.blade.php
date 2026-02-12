{{-- resources/views/layouts/footer.blade.php --}}
<footer class="bg-dark text-white py-4 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                <h5 class="fw-bold mb-3">
                    <i class="fas fa-hotel me-2"></i>Cuba Travel
                </h5>
                <p class="small text-muted">
                    Descubre los mejores hoteles y destinos turísticos en Cuba.
                    Tu puerta de entrada al caribe cubano.
                </p>
            </div>

            <div class="col-md-4 mb-3">
                <h5 class="fw-bold mb-3">Enlaces Rápidos</h5>
                <ul class="list-unstyled small">
                    <li class="mb-2">
                        <a href="{{ route('home') }}" class="text-decoration-none text-muted hover-text-white">
                            <i class="fas fa-chevron-right me-2"></i>Inicio
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#hotels" class="text-decoration-none text-muted hover-text-white">
                            <i class="fas fa-chevron-right me-2"></i>Hoteles
                        </a>
                    </li>
                    @auth
                        <li class="mb-2">
                            <a href="{{ route('admin.hotels.index') }}" class="text-decoration-none text-muted hover-text-white">
                                <i class="fas fa-chevron-right me-2"></i>Panel Administrativo
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>

            <div class="col-md-4 mb-3">
                <h5 class="fw-bold mb-3">Contacto</h5>
                <ul class="list-unstyled small">
                    <li class="mb-2">
                        <i class="fas fa-envelope me-2 text-primary"></i>
                        <span class="text-muted">info@cubatravel.com</span>
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-phone me-2 text-primary"></i>
                        <span class="text-muted">+53 7 123 4567</span>
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                        <span class="text-muted">La Habana, Cuba</span>
                    </li>
                </ul>
            </div>
        </div>

        <hr class="bg-secondary my-4">

        <div class="row">
            <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                <p class="mb-0 small text-muted">
                    &copy; {{ date('Y') }} Cuba E-commerce 365. Todos los derechos reservados.
                </p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <div class="social-links">
                    <a href="#" class="text-white me-3 text-decoration-none">
                        <i class="fab fa-facebook fa-lg"></i>
                    </a>
                    <a href="#" class="text-white me-3 text-decoration-none">
                        <i class="fab fa-twitter fa-lg"></i>
                    </a>
                    <a href="#" class="text-white me-3 text-decoration-none">
                        <i class="fab fa-instagram fa-lg"></i>
                    </a>
                    <a href="#" class="text-white text-decoration-none">
                        <i class="fab fa-whatsapp fa-lg"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    .hover-text-white:hover {
        color: white !important;
        transition: color 0.3s ease;
    }
</style>
