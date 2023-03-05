import { createRouter, createWebHistory } from "vue-router";
import NotFound from "../views/NotFound.vue";
import DefaultLayout from "../components/DefaultLayout.vue";
import AuthLayout from "../components/AuthLayout.vue";
import store from "../store";

const routes = [
  {
    path: "/",
    redirect: "/home",
    component: DefaultLayout,
    meta: { requiresAuth: true },
    children: [
      {
        path: "/home",
        name: "Main",
        meta: {requiresAuth: false,title: 'Электронное голосование | E-voting'},
        component: () => import('@/views/Main.vue')
      },
      {
        path: "/dashboard",
        name: "Dashboard",
        component: () => import('@/views/Dashboard.vue')
      },
      {
        path: "/my-surveys",
        name: "MySurveys",
        meta: {title: 'Электронное голосование | Мой опросы'},
        component: () => import('@/views/MySurveys.vue')
      },
      {
        path: "/surveys",
        name: "Surveys",
        meta: {requiresAuth: false, title: 'Электронное голосование | Все опросы'},
        component: () => import('@/views/Surveys.vue'),
      },
      {
        path: "/survey/:id",
        name: "Survey",
        meta: {requiresAuth: false},
        component: () => import('@/views/Survey.vue'),
      },
      {
        path: "/surveys/create",
        name: "SurveyCreate",
        meta: {title: 'Электронное голосование | Создать опросы'},
        component: () => import('@/views/SurveyCreate.vue')
      },
    ],
  },

  {
    path: "/auth",
    redirect: "/login",
    name: "Auth",
    component: AuthLayout,
    meta: {isGuest: true},
    children: [
      {
        path: "/login",
        name: "Login",
        component: () => import('@/views/auth/Login.vue'),
      },
      {
        path: "/register",
        name: "Register",
        component: () => import('@/views/auth/Register.vue'),
      },
      {
        path: "/forgot-password",
        name: "ForgotPassword",
        component: () => import('@/views/auth/ForgotPassword.vue'),
      },
      {
        path: "/reset-password/:token",
        name: "ResetPassword",
        component: () => import('@/views/auth/ResetPassword.vue'),
      }
    ],
  },
  {
    path: '/404',
    name: 'NotFound',
    component: NotFound
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
    if (to.meta.title){
        document.title=to.meta.title;
    }else{
        document.title=to.name;
    }
  if (to.meta.requiresAuth && !store.state.user.data) {
    next({ name: "Login" });
  } else if (store.state.user.data && to.meta.isGuest) {
    next({ name: "Surveys" });
  } else {
    next();
  }
});

export default router;
