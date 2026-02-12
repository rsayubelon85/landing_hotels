<!-- resources/js/components/HotelList.vue -->
<template>
    <div class="container py-5">
        <div class="row">
            <div class="col-12 text-center mb-4">
                <h2 class="fw-bold">Hotéis Destacados</h2>
                <p class="text-muted">Descubre nuestra selección de hoteles de lujo en Cuba</p>
            </div>
        </div>

        <div class="row">
            <div
                v-for="hotel in hotels"
                :key="hotel.id"
                class="col-md-4 mb-4"
            >
                <div class="card hotel-card">
                    <img
                        :src="hotel.image_url"
                        class="card-img-top"
                        :alt="hotel.name"
                        style="height: 200px; object-fit: cover;"
                    >
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title fw-bold">{{ hotel.name }}</h5>
                            <span class="badge bg-warning text-dark">
                                <i class="fas fa-star"></i> {{ hotel.rating }}
                            </span>
                        </div>
                        <p class="card-text text-muted small">{{ hotel.location }}</p>
                        <p class="card-text">{{ hotel.description.substring(0, 100) }}...</p>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="fw-bold fs-4 text-primary">${{ hotel.price.toFixed(2) }}</span>
                            <button class="btn btn-outline-primary btn-sm">Ver Detalles</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const hotels = ref([]);

onMounted(() => {
    axios.get('/api/hotels')
        .then(response => {
            hotels.value = response.data;
        })
        .catch(error => {
            console.error('Error loading hotels:', error);
        });
});
</script>
