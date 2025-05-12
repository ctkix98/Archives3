<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { fetchUser } from '@/composables/useAuth.js';

const name = ref('');
const email = ref('');
const password = ref('');
const error = ref('');
const router = useRouter();

const register = async () => {
  error.value = '';
  try {
    //await fetch('/sanctum/csrf-cookie', { credentials: 'include' });
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ?? '';

    const res = await fetch('/register', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', Accept: 'application/json',  'X-CSRF-TOKEN': csrfToken },
      credentials: 'include',
      body: JSON.stringify({
        name: name.value,
        email: email.value,
        password: password.value,
        password_confirmation: password.value,
      }),
    });

    if (!res.ok) {
      const data = await res.json();
      throw new Error(data.message || 'Inscription échouée');
    }

    await fetchUser();
    router.push('/home');
  } catch (err) {
    error.value = err.message;
  }
};
</script>

<template>
  <div>
    <h1>Créer un compte</h1>
    <form @submit.prevent="register">
      <input v-model="name" placeholder="Nom" required />
      <input v-model="email" type="email" placeholder="Email" required />
      <input v-model="password" type="password" placeholder="Mot de passe" required />
       <input v-model="confirmPassword" type="password" placeholder="Confirmez le mot de passe" required />

      <button type="submit">S’inscrire</button>
      <p v-if="error" style="color:red">{{ error }}</p>
    </form>
    <router-link to="/login">J’ai déjà un compte</router-link>
  </div>
</template>
