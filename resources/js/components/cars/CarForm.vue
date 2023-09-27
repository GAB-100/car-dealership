<template>
    <div>
        <h2 v-if="isNewCar">Add Car</h2>
        <h2 v-else>Edit Car</h2>
        <form @submit.prevent="submitForm">
            <div class="mb-3">
                <label for="model_name" class="form-label">Model Name:</label>
                <input class="form-control" type="text" id="model_name" v-model="car.model_name" required />
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea class="form-control" id="description" v-model="car.description" required></textarea>
            </div>
            <div class="mb-3">
                <label for="product_year" class="form-label">Produced Year:</label>
                <input class="form-control" type="number" id="product_year" v-model="car.product_year" required />
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price:</label>
                <input class="form-control" type="number" id="price" v-model="car.price" required />
            </div>
            <div class="mb-3">
                <label for="manufacturer_id" class="form-label">Manufacturer:</label>
                <select class="form-control" id="manufacturer_id" v-model="car.manufacturer_id">
                    <option v-for="mItem in manufacturers" :key="mItem.id" :value="mItem.id">
                        {{ mItem.title }}
                    </option>
                </select>
            </div>
            <button type="submit" v-if="isNewCar" class="btn btn-primary">Add Car</button>
            <button type="submit" v-else class="btn btn-primary">Update Car</button>
        </form>
    </div>
</template>
  
<script>
import axios from 'axios';

export default {
    data() {
        return {
            car: {
                model_name: '',
                description: '',
                product_year: '',
                price: 0,
                manufacturer_id: ''
            },
            manufacturers: []
        }
    },
    computed: {
        isNewCar() {
            return !this.$route.path.includes('edit');
        }
    },
    async created() {
        if (!this.isNewCar) {
            const response = await axios.get(`/api/cars/${this.$route.params.id}`);
            this.car = response.data;
        }

        const mResponse = await axios.get('/api/manufacturers');
        this.manufacturers = mResponse.data;
    },
    methods: {
        async submitForm() {
            try {
                if (this.isNewCar) {
                    await axios.post('/api/cars', this.car);
                } else {
                    await axios.put(`/api/cars/${this.$route.params.id}`, this.car);
                }
                this.$router.push('/');
            } catch (error) {
                console.error(error);
            }
        }
    }
}
</script>