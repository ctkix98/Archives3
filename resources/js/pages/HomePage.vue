<script setup>
import { ref, onMounted } from 'vue';
import { currentUser, logout } from '@/composables/useAuth.js';
import { useRouter } from 'vue-router';
import StoryCard from '@/components/StoryCard.vue';

const router = useRouter();
const stories = ref([]);
const loading = ref(true);

const handleLogout = async () => {
  await logout();
  router.push('/login');
};

onMounted(async () => {
  try {
    const res = await fetch('/api/v1/stories');
    stories.value = await res.json();
  } catch (e) {
    console.error('Erreur lors du chargement des histoires', e);
  } finally {
    loading.value = false;
  }
});
</script>

<template>
  <div>
    <header style="display: flex; justify-content: space-between; align-items: center;">
      <h1>Bienvenue {{ currentUser?.name || 'utilisateur' }}</h1>
      <button @click="handleLogout">Déconnexion</button>
    </header>

    <div v-if="loading">Chargement des histoires...</div>

    <div v-else>
      <StoryCard
        v-for="story in stories"
        :key="story.id"
        :story="story"
      />
    </div>
  </div>
</template>
