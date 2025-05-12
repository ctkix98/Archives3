import { ref } from 'vue';

export const currentUser = ref(null);

export async function fetchUser() {
  try {
    const res = await fetch('/user', {
      headers: { Accept: 'application/json' },
      credentials: 'include',
    });

    if (!res.ok) throw new Error('Non connecté');

    currentUser.value = await res.json();
  } catch (e) {
    currentUser.value = null;
  }
}

export async function logout() {
  await fetch('/logout', {
    method: 'POST',
    headers: { 'Accept': 'application/json' },
    credentials: 'include',
  });

  currentUser.value = null;
}
