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

</style>