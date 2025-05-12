<script setup>
import { useRouter } from 'vue-router';

const props = defineProps({ story: Object });
const router = useRouter();

const goToStory = async () => {
  try {
    const res = await fetch(`/api/v1/stories/${props.story.id}`);
    console.log(props.story.id)
    if (!res.ok) throw new Error('Erreur lors du chargement de l’histoire');

    const data = await res.json();
    const firstChapter = data.chapters?.[0];

    if (!firstChapter) {
      alert('Aucun chapitre disponible pour cette histoire.');
      return;
    }

    router.push(`/chapter/${firstChapter.id}`);
  } catch (error) {
    console.error(error);
    alert("Impossible de charger le premier chapitre.");
  }
};
</script>

<template>
  <div class="story-card" @click="goToStory">
    <h2>{{ story.title }}</h2>
    <p>{{ story.description }}</p>
  </div>
</template>

<style scoped>
.story-card {
  border: 1px solid #ccc;
  padding: 1rem;
  margin-bottom: 1rem;
  border-radius: 8px;
  cursor: pointer;
  transition: 0.3s;
}
.story-card:hover {
  background-color: #f3f3f3;
}
</style>
