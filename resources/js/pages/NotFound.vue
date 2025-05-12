<!-- NotFound.vue -->
<script setup>
import { currentUser } from '@/composables/useAuth.js';
import { useRouter } from 'vue-router';

const router = useRouter();

function redirect() {
  if (currentUser.value) {
    router.push('/home');
  } else {
    router.push('/login');
  }
}
</script>

<template>
  <div class="notfound-page">
    <div class="notfound-card">
      <h1>404 - Cette page n'existe pas</h1>
      <p>La page que vous cherchez est introuvable.</p>
      <button @click="redirect">Retourner à la page appropriée</button>
    </div>
  </div>
</template>

<style scoped>
.notfound-page {
  min-height: 50vh;
  background-color: var(--white);
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 2rem;
  font-family: sans-serif;
}

.notfound-card {
  padding: 2rem 3rem;
  border-radius: 8px;
  text-align: center;
  max-width: 500px;
}

.notfound-card h1 {
  font-size: 2rem;
  margin-bottom: 1rem;
  color: var(--black);
}

.notfound-card p {
  margin-bottom: 1.5rem;
  font-size: 1rem;
  color: var(--black);
}

button {
  background-color: var(--black);
  color: var(--white);
  padding: 0.75rem 1.5rem;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-weight: bold;
  transition: background 0.3s ease;
}

button:hover {
  background-color: var(--gray-dark);
}
</style>