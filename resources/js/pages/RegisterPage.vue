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
  <div class="register-page">
    <div class="register-card">
      <h1>Créer un compte</h1>
      <form @submit.prevent="register">
        <input v-model="name" placeholder="Nom" required />
        <input v-model="email" type="email" placeholder="Email" required />
        <input v-model="password" type="password" placeholder="Mot de passe" required />
        <input v-model="confirmPassword" type="password" placeholder="Confirmez le mot de passe" required />

        <button type="submit">S’inscrire</button>
        <p v-if="error" class="error">{{ error }}</p>
      </form>

      <router-link to="/login" class="link-login">J’ai déjà un compte</router-link>
    </div>
  </div>
</template>

<style scoped>
.register-page {
  min-height: 85vh;
  background-color: var(--white);
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 2rem;
}

.register-card {
  padding: 2rem;
  border-radius: 8px;
  width: 100%;
  max-width: 400px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.register-card h1 {
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

.link-login {
  display: block;
  text-align: center;
  margin-top: 1rem;
  color: var(--black);
  text-decoration: underline;
}
</style>