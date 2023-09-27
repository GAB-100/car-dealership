<template>
  <div>
    <div class="mb-3">
      <label for="manufacturer_id" class="form-label">Manufacturer:</label>
      <select class="form-control" id="manufacturer_id" v-model="filteredManufacturer"
        @change="filterCarsByManufacturer($event)">
        <option value=""></option>
        <option v-for="mItem in manufacturers" :key="mItem.id" :value="mItem.id">
          {{ mItem.title }}
        </option>
      </select>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Model Name</th>
          <th scope="col">Description</th>
          <th scope="col">Produced Year</th>
          <th scope="col">Price</th>
          <th scope="col">Manufacturer</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="car in filteredResult" :key="car.id">
          <td>{{ car.id }}</td>
          <td>{{ car.model_name }}</td>
          <td>{{ car.description }}</td>
          <td>{{ car.product_year }}</td>
          <td>{{ car.price }}</td>
          <td>{{ car.manufacturer_id }}</td>
          <td>
            <div class="row gap-3">
              <router-link :to="`/cars/${car.id}`" class="p-2 col border btn btn-primary">View</router-link>
              <router-link :to="`/cars/${car.id}/edit`" class="p-2 col border btn btn-success">Edit</router-link>
              <button @click="deleteCar(car.id)" type="button" class="p-2 col border btn btn-danger">Delete</button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { computeStyles } from '@popperjs/core';
import axios from 'axios';

export default {
  data() {
    return {
      cars: [],
      filteredResult: [],
      manufacturers: [],
      filteredManufacturer: '',
    }
  },
  async created() {
    try {
      const response = await axios.get('/api/cars');
      this.cars = response.data;
      this.filteredResult = this.cars;

      const mResponse = await axios.get('/api/manufacturers');
      this.manufacturers = mResponse.data;
    } catch (error) {
      console.error(error);
    }
  },
  methods: {
    async deleteCar(id) {
      try {
        await axios.delete(`/api/cars/${id}`);
        this.cars = this.cars.filter(car => car.id !== id);
      } catch (error) {
        console.error(error);
      }
    },
    filterCarsByManufacturer(event) {
      console.log('Debug item: ', typeof event.target.value);
      if (event.target.value) {
        this.filteredResult = this.cars.filter((cItem) => cItem.manufacturer_id === Number(event.target.value));
      } else {
        this.filteredResult = this.cars;
      }
    }
  }
}
</script>