<script setup>
import { currentUser, logout } from '@/composables/useAuth.js';
import { useRouter } from 'vue-router';

const router = useRouter();

const handleLogout = async () => {
  await logout();
  router.push('/login');
};
</script>

<template>
  <div>
    <h1>Bienvenue {{ currentUser?.name || 'utilisateur' }}</h1>
    <button @click="handleLogout">Déconnexion</button>
  </div>
</template>
