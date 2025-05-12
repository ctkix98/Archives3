<script setup>
  import { ref } from 'vue';
  import TheHeader from '@/components/TheHeader.vue';
  import TheFooter from './components/TheFooter.vue';
  const n = ref(1);
</script>

<template>
  <div>
    <TheHeader />
    <main>
      <router-view />
    </main>
    <TheFooter/>
  </div>
</template>


<style scoped>
.app-layout {
  display: flex;
  flex-direction: column;
  min-height: 100vh; /* ✅ occupe toute la hauteur */
}

.app-main {
  flex: 1; /* ✅ pousse le footer en bas */
  padding: 1rem;
}
</style>