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
  <div v-if="chapter">
    <h2>{{ chapter.title }}</h2>
    <p>{{ chapter.text }}</p>

    <ul v-if="chapter.choices.length">
      <li v-for="choice in chapter.choices" :key="choice.id">
        <router-link :to="`/chapter/${choice.target_chapter_id}`">
          {{ choice.text }}
        </router-link>
      </li>
    </ul>

    <!-- ✅ Si aucun choix, afficher bouton retour -->
    <div v-else>
      <p>Fin de l'histoire !</p>
      <button @click="goHome">Retour à l'accueil</button>
    </div>
  </div>

  <div v-else>
    Chargement...
  </div>
</template>
