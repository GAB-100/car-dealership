<template>
    <div>
        <h5 id="associating-form-text-with-form-controls">Title:</h5>
        <h6>{{ manufacturer.title }}</h6>
        <h5 id="associating-form-text-with-form-controls">Description:</h5>
        <p>{{ manufacturer.description }}</p>
        <router-link :to="`/manufacturers/${manufacturer.id}/edit`" class="btn btn-primary">Edit</router-link>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            manufacturer: {}
        }
    },
    async created() {
        try {
            const response = await axios.get(`/api/manufacturers/${this.$route.params.id}`);
            this.manufacturer = response.data;
        } catch (error) {
            console.error(error);
        }
    }
}
</script>