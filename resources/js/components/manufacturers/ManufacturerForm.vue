<template>
    <div>
        <h2 v-if="isNewManufacturer">Add Manufacturer</h2>
        <h2 v-else>Edit Manufacturer</h2>
        <form @submit.prevent="submitForm">
            <div class="mb-3">
                <label for="model_name" class="form-label">Title:</label>
                <input class="form-control" type="text" id="model_name" v-model="manufacturer.title" required />
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea class="form-control" id="description" v-model="manufacturer.description" required></textarea>
            </div>
            <button type="submit" v-if="isNewManufacturer" class="btn btn-primary">Add Manufacturer</button>
            <button type="submit" v-else class="btn btn-primary">Update Manufacturer</button>
        </form>
    </div>
</template>
  
<script>
import axios from 'axios';

export default {
    data() {
        return {
            manufacturer: {
                title: '',
                description: '',
            }
        }
    },
    computed: {
        isNewManufacturer() {
            return !this.$route.path.includes('edit');
        }
    },
    async created() {
        if (!this.isNewManufacturer) {
            const response = await axios.get(`/api/manufacturers/${this.$route.params.id}`);
            this.manufacturer = response.data;
        }
    },
    methods: {
        async submitForm() {
            try {
                if (this.isNewManufacturer) {
                    await axios.post('/api/manufacturers', this.manufacturer);
                } else {
                    await axios.put(`/api/manufacturers/${this.$route.params.id}`, this.manufacturer);
                }
                this.$router.push('/');
            } catch (error) {
                console.error(error);
            }
        }
    }
}
</script>