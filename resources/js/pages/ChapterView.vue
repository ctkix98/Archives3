<script setup>
import { ref, onMounted, watch } from 'vue';
import { useRoute } from 'vue-router';

const chapter = ref(null);
const route = useRoute();

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
</script>

<template>
  <div v-if="chapter">
    <h2>{{ chapter.title }}</h2>
    <p>{{ chapter.text }}</p>

    <ul>
      <li v-for="choice in chapter.choices" :key="choice.id">
        <router-link :to="`/chapter/${choice.target_chapter_id}`">
          {{ choice.text }}
        </router-link>
      </li>
    </ul>
  </div>
  <div v-else>
    Chargement...
  </div>
</template>
