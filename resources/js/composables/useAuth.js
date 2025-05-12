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
    // Si l'utilisateur n'est pas connecté ou erreur réseau
    currentUser.value = null;
  }
}

export async function logout() {
  await fetch('/logout', {
    method: 'POST',
    headers: {
      'Accept': 'application/json',
      'X-Requested-With': 'XMLHttpRequest',
      // Token CSRF requis par Laravel pour sécuriser les requêtes POST
      'X-XSRF-TOKEN': decodeURIComponent(getCookie('XSRF-TOKEN')),
    },
    credentials: 'include',
    
    
  });

  currentUser.value = null;
  // Recharge l’app pour forcer un état non-authentifié
  window.location.reload();
}
function getCookie(name) {
  return document.cookie
    .split('; ')
    .find(row => row.startsWith(name + '='))
    ?.split('=')[1];
}
