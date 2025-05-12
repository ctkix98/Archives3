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
  <div style="text-align:center; margin-top: 50px;">
    <h1>404 - Cette page n'existe pas</h1>
    <p>
      <button @click="redirect">Retourner à la page appropriée</button>
    </p>
  </div>
</template>
