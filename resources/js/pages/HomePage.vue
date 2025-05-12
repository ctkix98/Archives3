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
  <div class="homepage">
    <header class="homepage-header">
      <h1>Bienvenue {{ currentUser?.name || 'utilisateur' }}</h1>
    </header>

    <div class="homepage-content">
      <div v-if="loading" class="loading">Chargement des histoires...</div>

      <div v-else class="stories-grid">
        <StoryCard
          v-for="story in stories"
          :key="story.id"
          :story="story"
        />
      </div>
    </div>
  </div>
</template>

<style scoped>
.homepage {
  min-height: 100vh;
  background-color: var(--white);
  color: var(--gray-dark);
  display: flex;
  flex-direction: column;
  font-family: sans-serif;
}

.homepage-header {
  color: var(--black);
  padding: 1rem 2rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 50px;
}

.homepage-header h1 {
  font-size: 1.3rem;
  font-weight: bold;
}


button {
  background-color: var(--black);
  color: var(--white);
  border: none;
  padding: 0.5rem 1.2rem;
  border-radius: 0.25rem;
  cursor: pointer;
  transition: background 0.3s ease;
}

button:hover {
  background-color: var(--gray-dark);
}

.homepage-content {
  padding: 2rem;
  flex-grow: 1;
}

.loading {
  font-size: 1.2rem;
  text-align: center;
  margin-top: 2rem;
}

.stories-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 1.5rem;

}

</style>
