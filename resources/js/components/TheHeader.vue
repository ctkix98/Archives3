<script setup>
import { currentUser, logout } from '@/composables/useAuth';
import { useRouter } from 'vue-router';


const router = useRouter();

const handleLogout = async () => {
  await logout();
  router.push('/login');
};
</script>

<template>
  <header class="header">
    <h1>Histoires du Tour de France </h1>
    <button v-if="currentUser" @click="handleLogout" class="logout-btn">
      Déconnexion
    </button>
  </header>
</template>

<style scoped>
.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: var(--yellow);
  color: var(--black);
  padding: 3rem 2rem;
  font-family: sans-serif;
}

h1 {
  font-size: 1.5rem;
  font-weight: bold;
}

.logout-btn {
  background-color: var(--black);
  color: var(--white);
  border: none;
  padding: 0.5rem 1rem;
  border-radius: 0.25rem;
  cursor: pointer;
}

.logout-btn:hover {
  background-color: var(--gray-dark);
}
</style>