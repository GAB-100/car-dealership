<template>
  <div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="manufacturer in manufacturers" :key="manufacturer.id">
          <td>{{ manufacturer.id }}</td>
          <td>{{ manufacturer.title }}</td>
          <td>{{ manufacturer.description }}</td>
          <td>
            <div class="row gap-3">
              <router-link :to="`/manufacturers/${manufacturer.id}`" class="p-2 col border btn btn-primary">View</router-link>
              <router-link :to="`/manufacturers/${manufacturer.id}/edit`" class="p-2 col border btn btn-success">Edit</router-link>
              <button @click="deleteItem(manufacturer.id)" type="button" class="p-2 col border btn btn-danger">Delete</button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      manufacturers: []
    }
  },
  async created() {
    try {
      const response = await axios.get('/api/manufacturers');
      this.manufacturers = response.data;
    } catch (error) {
      console.error(error);
    }
  },
  methods: {
    async deleteItem(id) {
      try {
        await axios.delete(`/api/manufacturers/${id}`);
        this.manufacturers = this.manufacturers.filter(manufacturer => manufacturer.id !== id);
      } catch (error) {
        console.error(error);
      }
    }
  }
}
</script>