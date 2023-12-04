import { createWebHistory, createRouter } from "vue-router";
import Registration from "../pages/Registration.vue";
import Home from "../pages/Home.vue";

const routes = [
    { path: "/", component: Home, name: "home" },
    { path: "/registration", component: Registration, name: "registration" },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
