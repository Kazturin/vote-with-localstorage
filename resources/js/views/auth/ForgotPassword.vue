<template>
    <div>
        <!--    <img-->
        <!--      class="mx-auto h-12 w-auto"-->
        <!--      src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"-->
        <!--      alt="Workflow"-->
        <!--    />-->
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
            Сброс пароля
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
            <router-link
                :to="{ name: 'Login' }"
                class="font-medium text-indigo-600 hover:text-indigo-500"
            >
               Войти
            </router-link>
        </p>
    </div>
    <form class="mt-8 space-y-6" @submit="reset">
        <Alert v-if="responseMsg" :class="[responseMsg.status?'bg-green-500':'bg-red-500']">
            {{ responseMsg.message }}
            <span
                @click="errorMsg = ''"
                class="w-8 h-8 flex items-center justify-center rounded-full transition-colors cursor-pointer hover:bg-[rgba(0,0,0,0.2)]"
            >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
        >
          <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M6 18L18 6M6 6l12 12"
          />
        </svg>
      </span>
        </Alert>
        <input type="hidden" name="remember" value="true" />
        <div class="rounded-md shadow-sm -space-y-px">
            <div>
                <label for="email-address" class="sr-only">Email address</label>
                <input
                    id="email-address"
                    name="email"
                    type="email"
                    autocomplete="email"
                    required=""
                    v-model="user.email"
                    class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                    placeholder="Email address"
                />
            </div>
        </div>

        <div>
            <TButtonLoading :loading="loading" class="w-full relative justify-center">
        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
          <LockClosedIcon
              class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400"
              aria-hidden="true"
          />
        </span>
                Отправить почту
            </TButtonLoading>
        </div>
    </form>
</template>

<script setup>
import { LockClosedIcon } from "@heroicons/vue/solid";
import store from "../../store";
import {useRoute, useRouter} from "vue-router";
import { ref } from "vue";
import Alert from "../../components/Alert.vue";
import TButtonLoading from "../../components/core/TButtonLoading.vue";


const router = useRouter();
const route = useRoute();

const user = {
    email: "",
};
let loading = ref(false);
let responseMsg = ref("");

function reset(ev) {
    ev.preventDefault();

    loading.value = true;
    store
        .dispatch("forgotPassword", user)
        .then((res) => {
            loading.value = false;
            responseMsg.value = res
            // router.push({
            //     name: "Dashboard",
            // });
        })
        .catch((err) => {
            loading.value = false;
            responseMsg.value = err.response.data.error;
        });
}
</script>
