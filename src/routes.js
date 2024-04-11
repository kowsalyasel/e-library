
import { createRouter, createWebHistory } from "vue-router";

import WelcomeItem from "./components/WelcomeItem.vue";



const routes = [
  {
    path: "/WelcomeItem",
    name: "WelcomeItem",
    component: ()=>import("./components/WelcomeItem.vue"),
  },
];


const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;