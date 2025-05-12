<script setup>
import { ref, onMounted, watch } from 'vue';
import { useRoute, useRouter } from 'vue-router';

const chapter = ref(null);
const route = useRoute();
const router = useRouter();

const loadChapter = async (id) => {
  const res = await fetch(`/api/v1/chapters/${id}`);
  chapter.value = await res.json();
};

onMounted(() => {
  loadChapter(route.params.id);
});

watch(() => route.params.id, (newId) => {
  loadChapter(newId);
});

const goHome = () => {
  router.push('/home');
};
</script>

<template>
  <div class="chapter-view" v-if="chapter">
    <div class="chapter-header">
      <button @click="goHome" class="home-button">🏠 Accueil</button>
    </div>

    <h2 class="chapter-title">{{ chapter.title }}</h2>
    <p class="chapter-text">{{ chapter.text }}</p>

    <ul v-if="chapter.choices.length" class="choices-list">
      <li v-for="choice in chapter.choices" :key="choice.id">
        <router-link :to="`/chapter/${choice.target_chapter_id}`" class="choice-link">
          {{ choice.text }}
        </router-link>
      </li>
    </ul>

    <div v-else class="end-screen">
      <p class="chapter-end">Fin de l'histoire !</p>
      <button @click="goHome" class="back-button">Retour à l'accueil</button>
    </div>
  </div>

  <div v-else class="loading">
    Chargement...
  </div>
</template>


<style scoped>
.chapter-view {
  min-height: 80vh;
  margin: 2rem auto;
  padding: 2rem;
  background-color: var(--white);
  border-radius: 8px;
}

.chapter-title {
  font-size: 2rem;
  font-weight: bold;
  margin-bottom: 1rem;
  color: var(--black);
}

.chapter-text {
  font-size: 1.2rem;
  line-height: 1.6;
  color: var(--gray-dark);
  margin-bottom: 2rem;
}

.choices-list {
  list-style: none;
  padding: 0;
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.choice-link {
  display: block;
  background-color: var(--yellow);
  color: var(--black);
  padding: 1rem;
  border-radius: 6px;
  font-weight: bold;
  text-decoration: none;
  transition: background 0.2s;
}

.choice-link:hover {
  background-color: var(--yellow-dark, #e6c200);
}

.end-screen {
  text-align: center;
}

.chapter-end {
  font-size: 1.2rem;
  font-weight: bold;
  margin-bottom: 1rem;
}

.back-button {
  background-color: var(--black);
  color: var(--white);
  padding: 0.75rem 1.5rem;
  border: none;
  border-radius: 6px;
  cursor: pointer;
}

.back-button:hover {
  background-color: var(--gray-dark);
}

.loading {
  text-align: center;
  margin-top: 3rem;
  font-size: 1.2rem;
}

.home-button {
  background-color: var(--black);
  color: var(--white);
  border: none;
  padding: 0.4rem 1rem;
  border-radius: 6px;
  font-weight: bold;
  cursor: pointer;
  transition: background 0.2s ease;
  margin-bottom: 10%;
}

.home-button:hover {
  background-color: var(--gray-dark);
}
</style>
