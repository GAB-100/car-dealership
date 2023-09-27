/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import "./bootstrap";
import { createApp } from "vue";
import { createRouter, createWebHistory } from "vue-router";

import App from "./components/App.vue";
import CarList from "./components/cars/CarList.vue";
import CarForm from "./components/cars/CarForm.vue";
import Car from "./components/cars/Car.vue";
import ManufacturerList from './components/manufacturers/ManufacturerList.vue';
import ManufacturerForm from './components/manufacturers/ManufacturerForm.vue';
import Manufacturer from './components/manufacturers/Manufacturer.vue';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: "/", component: CarList },
        { path: "/cars/create", component: CarForm },
        { path: "/cars/:id", component: Car },
        { path: "/cars/:id/edit", component: CarForm },
        { path: "/manufacturers", component: ManufacturerList },
        { path: "/manufacturers/create", component: ManufacturerForm },
        { path: "/manufacturers/:id", component: Manufacturer },
        { path: "/manufacturers/:id/edit", component: ManufacturerForm },
    ],
});

const app = createApp(App);
app.use(router);
app.mount("#app");
