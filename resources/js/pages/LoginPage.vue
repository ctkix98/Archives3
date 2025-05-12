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
    //await fetch('/sanctum/csrf-cookie', { credentials: 'include' });
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ?? '';

    const res = await fetch('/login', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', Accept: 'application/json', 'X-CSRF-TOKEN': csrfToken },
      credentials: 'include',
      body: JSON.stringify({ email: email.value, password: password.value }),
    });

    if (!res.ok) throw new Error('Email ou mot de passe invalide');

    // Met à jour currentUser dans le store global
    await fetchUser();
    // Redirige vers la page d'accueil après connexion
    router.push('/home');
  } catch (err) {
    error.value = err.message;
  }
};
</script>

<template>
  <div class="login-page">
    <div class="login-card">
      <h1>Connexion</h1>
      <form @submit.prevent="login">
        <input v-model="email" type="email" placeholder="Email" required />
        <input v-model="password" type="password" placeholder="Mot de passe" required />
        <button type="submit">Se connecter</button>
        <p v-if="error" class="error">{{ error }}</p>
      </form>
      <router-link to="/register" class="link-register">
        Créer un compte
      </router-link>
    </div>
  </div>
</template>

<style scoped>
.login-page {
  min-height: 80vh;
  background-color: var(--white);
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 2rem;
}

.login-card {

  padding: 2rem;
  border-radius: 8px;
  width: 100%;
  max-width: 400px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.login-card h1 {
  text-align: center;
  margin-bottom: 1.5rem;
  color: var(--black);
}

form {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

input {
  padding: 0.75rem 1rem;
  border: 1px solid var(--black);
  border-radius: 4px;
  font-size: 1rem;
}

button {
  background-color: var(--black);
  color: var(--white);
  border: none;
  padding: 0.75rem;
  border-radius: 4px;
  font-weight: bold;
  cursor: pointer;
  transition: background 0.3s ease;
}

button:hover {
  background-color: var(--gray-dark);
}

.error {
  color: red;
  text-align: center;
}

.link-register {
  display: block;
  text-align: center;
  margin-top: 1rem;
  color: var(--black);
  text-decoration: underline;
}
</style>