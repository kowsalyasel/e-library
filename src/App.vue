<script setup>
import { useRouter } from 'vue-router';

// Importing TheWelcome component
import TheWelcome from './components/TheWelcome.vue';

const router = useRouter();
const isAuthenticated = localStorage.getItem("token");

// Check if the user is authenticated
if (isAuthenticated) {
  // If authenticated, redirect to /WelcomeItem
  router.push("/WelcomeItem");
}
</script>

<template>
  <div id="app">
   
    <router-view v-if="!isAuthenticated"></router-view>
   
    <main v-else>
      <TheWelcome />
    </main>
  </div>
</template>


<style scoped>
header {
  line-height: 1.5;
}

.logo {
  display: block;
  margin: 0 auto 2rem;
}

@media (min-width: 1024px) {
  header {
    display: flex;
    place-items: center;
    padding-right: calc(var(--section-gap) / 2);
  }

  .logo {
    margin: 0 2rem 0 0;
  }

  header .wrapper {
    display: flex;
    place-items: flex-start;
    flex-wrap: wrap;
  }
}
</style>
