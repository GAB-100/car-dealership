<template>
    <div>
        <h5 id="associating-form-text-with-form-controls">Model Name:</h5>
        <h6>{{ car.model_name }}</h6>
        <h5 id="associating-form-text-with-form-controls">Description:</h5>
        <h6>{{ car.description }}</h6>
        <h5 id="associating-form-text-with-form-controls">Produced Year:</h5>
        <p>{{ car.product_year }}</p>
        <h5 id="associating-form-text-with-form-controls">Price:</h5>
        <p>Price: {{ car.price }}</p>
        <h5 id="associating-form-text-with-form-controls">Manufacturer:</h5>
        <p>Price: {{ car.manufacturer_id }}</p>
        <router-link :to="`/cars/${car.id}/edit`" class="btn btn-primary">Edit</router-link>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            car: {}
        }
    },
    async created() {
        try {
            const response = await axios.get(`/api/cars/${this.$route.params.id}`);
            this.car = response.data;
        } catch (error) {
            console.error(error);
        }
    }
}
</script>