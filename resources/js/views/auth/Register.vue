<template>
  <div>
    <div>
        <router-link :to="{name:'Main'}">
            <img
                class="mx-auto h-12 w-auto"
                src="https://votekzfree.tk/img/logo.png"
                alt="Workflow"
            />
        </router-link>
      <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
        Регистрация
      </h2>
      <p class="mt-2 text-center text-sm text-gray-600">
        или
        {{ " " }}
        <router-link
          :to="{ name: 'Login' }"
          class="font-medium text-indigo-600 hover:text-indigo-500"
        >
            Войдите в свой аккаунт
        </router-link>
      </p>
    </div>
    <form class="mt-8 space-y-6" @submit="register">
      <Alert
        v-if="Object.keys(errors).length"
        class="flex-col items-stretch text-sm bg-red-500"
      >
        <div v-for="(field, i) of Object.keys(errors)" :key="i">
          <div v-for="(error, ind) of errors[field] || []" :key="ind">
            * {{ error }}
          </div>
        </div>
      </Alert>

      <input type="hidden" name="remember" value="true" />
      <div class="rounded-md shadow-sm -space-y-px">
        <TInput
          name="name"
          v-model="user.name"
          :errors="errors"
          placeholder="Имя"
          inputClass="rounded-t-md"
        />
        <TInput
          name="email"
          v-model="user.email"
          :errors="errors"
          placeholder="Email"
        />
        <TInput
          type="password"
          name="password"
          v-model="user.password"
          :errors="errors"
          placeholder="Пароль"
        />
        <TInput
          type="password"
          name="password_confirmation"
          v-model="user.password_confirmation"
          :errors="errors"
          placeholder="Повторите пароль"
          inputClass="rounded-b-md"
        />
      </div>
      <div>
        <TButtonLoading
          :loading="loading"
          class="w-full relative justify-center"
        >
          Регистрация
        </TButtonLoading>
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { LockClosedIcon } from "@heroicons/vue/solid";
import store from "../../store";
import { useRouter } from "vue-router";
import TButtonLoading from "../../components/core/TButtonLoading.vue";
import TInput from "../../components/core/TInput.vue";
import Alert from "../../components/Alert.vue";

const router = useRouter();
const user = {
  name: "",
  email: "",
  password: "",
};
const loading = ref(false);
const errors = ref({});

function register(ev) {
  ev.preventDefault();
  loading.value = true;
  store
    .dispatch("register", user)
    .then(() => {
      loading.value = false;
        store.commit("notify", {
            type: "success",
            message: "Успешно!",
        });
      router.push({
        name: "Surveys",
      });
    })
    .catch((error) => {
      loading.value = false;
      if (error.response.status === 422) {
        errors.value = error.response.data.errors;
      }
    });
}
</script>
