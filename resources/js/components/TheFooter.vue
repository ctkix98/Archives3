<script setup>
// Rien à importer ici, composant purement visuel
</script>

<template>
  <footer class="app-footer">
    <p>&copy; {{ new Date().getFullYear() }} Made with love and tears by Cédrine Tille</p>
  </footer>
</template>

<style scoped>
.app-footer {
  background-color: var(--black);
  color: var(--white);
  text-align: center;
  padding: 1rem 2rem;
  font-size: 0.9rem;
  margin-top: auto;
}
</style>
