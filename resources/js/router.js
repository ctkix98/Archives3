import { createRouter, createWebHistory } from "vue-router";
import LoginPage from "@/pages/LoginPage.vue";
import RegisterPage from "@/pages/RegisterPage.vue";
import HomePage from "@/pages/HomePage.vue";
import NotFound from "./pages/NotFound.vue";
import { fetchUser, currentUser } from "@/composables/useAuth.js";

const routes = [
    { path: "/", redirect: "/login" },
    { path: "/login", component: LoginPage },
    { path: "/register", component: RegisterPage },
    { path: "/home", component: HomePage },
    {
        path: "/chapter/:id",
        name: "ChapterView",
        component: () => import("@/pages/ChapterView.vue"),
        props: true,
    },
    {
        path: "/:pathMatch(.*)*", // match toutes les routes inconnues
        name: "NotFound",
        component: NotFound,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

// Garde de navigation pour protéger /home
router.beforeEach(async (to, from, next) => {
    if (currentUser.value === null) await fetchUser();

    const loggedIn = !!currentUser.value;

    // Protège /home : redirige vers /login si non connecté
    if (to.path === "/home" && !loggedIn) {
        next("/login");
        // Empêche l'accès à /login ou /register si déjà connecté
    } else if ((to.path === "/login" || to.path === "/register") && loggedIn) {
        next("/home");
    } else {
        // Autorise la navigation
        next();
    }
});

export default router;
