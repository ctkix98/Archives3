<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { fetchUser } from '@/composables/useAuth.js';

const email = ref('');
const password = ref('');
const error = ref('');
const router = useRouter();

const login = async () => {
  error.value = '';
  try {
    await fetch('/sanctum/csrf-cookie', { credentials: 'include' });

    const res = await fetch('/login', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', Accept: 'application/json' },
      credentials: 'include',
      body: JSON.stringify({ email: email.value, password: password.value }),
    });

    if (!res.ok) throw new Error('Email ou mot de passe invalide');

    await fetchUser();
    router.push('/home');
  } catch (err) {
    error.value = err.message;
  }
};
</script>

<template>
  <div>
    <h1>Connexion</h1>
    <form @submit.prevent="login">
      <input v-model="email" type="email" placeholder="Email" required />
      <input v-model="password" type="password" placeholder="Mot de passe" required />
      <button type="submit">Se connecter</button>
      <p v-if="error" style="color:red">{{ error }}</p>
    </form>
    <router-link to="/register">Créer un compte</router-link>
  </div>
</template>
