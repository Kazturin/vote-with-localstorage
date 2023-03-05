<template>
  <PageComponent title="Добавить опрос">
    <template v-slot:header>
      <div>
      </div>
    </template>
      <div v-if="errorMsg">
              <Alert class="mb-2 bg-red-500">
                  {{errorMsg}}
                  <span
                      @click="error = ''"
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
      </div>
    <div v-if="surveyLoading" class="flex justify-center">Loading...</div>
    <form v-else @submit.prevent="saveSurvey" class="animate-fade-in-down">
      <div class="shadow sm:rounded-md sm:overflow-hidden">
        <!-- Survey Fields -->
        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
          <!-- Image -->
          <div>
            <label class="block text-sm font-medium text-gray-700">
              Картинка
            </label>
            <div class="mt-1 flex items-center">
              <img
                v-if="model.image_url"
                :src="model.image_url"
                :alt="model.title"
                class="w-64 h-48 object-cover"
              />
              <span
                v-else
                class="flex items-center justify-center h-12 w-12 rounded-full overflow-hidden bg-gray-100"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-[80%] w-[80%] text-gray-300"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                >
                  <path
                    fill-rule="evenodd"
                    d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                    clip-rule="evenodd"
                  />
                </svg>
              </span>
              <button
                type="button"
                class="relative overflow-hidden ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
              >
                <input
                  type="file"
                  @change="onImageChoose"
                  class="absolute left-0 top-0 right-0 bottom-0 opacity-0 cursor-pointer"
                />
                Загрузить
              </button>
            </div>
          </div>
          <!--/ Image -->

          <!-- Title -->
          <div>
            <label for="title" class="block text-sm font-medium text-gray-700"
              >Вопрос</label
            >
            <input
              type="text"
              name="title"
              id="title"
              v-model="model.title"
              autocomplete="survey_title"
              class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
            />
          </div>
          <!--/ Title -->

          <!-- Category -->
          <div>
            <label for="category" class="block text-sm font-medium text-gray-700">
              Категория
            </label>
            <div class="mt-1">
                <select class="w-1/3 form-select px-4 py-3 pr-8 rounded-md border-gray-300 focus:border-gray-500"
                        name="category_id"
                        id="category"
                        v-model="model.category_id">
                    <option v-for="category in categories" :key="category.id" :value="category.id">
                        {{category.name}}
                    </option>

                </select>
            </div>
          </div>
          <!-- Category -->

          <!-- Expire Date -->
          <div>
            <label
              for="expire_date"
              class="block text-sm font-medium text-gray-700"
              >Активен до</label
            >
            <input
              type="date"
              name="expire_date"
              id="expire_date"
              v-model="model.expire_date"
              class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
            />
          </div>
          <!--/ Expire Date -->

          <!-- Status -->
          <div class="flex items-start">
            <div class="flex items-center h-5">
              <input
                id="status"
                name="status"
                type="checkbox"
                v-model="model.status"
                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"
              />
            </div>
            <div class="ml-3 text-sm">
              <label for="status" class="font-medium text-gray-700"
                >Всегда активно</label
              >
            </div>
          </div>
          <!--/ Status -->
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700">
                    Статус
                </label>
                <div class="mt-1">
                    <select class="w-1/3 form-select px-4 py-3 pr-8 rounded-md border-gray-300 focus:border-gray-500"
                            name="availability"
                            id="availability"
                            v-model="model.availability">
                        <option :value="true">Публичный</option>
                        <option :value="false">Приватный(доступно по url)</option>
                    </select>
                </div>
            </div>

        </div>
        <!--/ Survey Fields -->

        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
          <h3 class="text-2xl font-semibold flex items-center justify-between">
            Варианты ответов

            <!-- Add new question -->
            <button
              type="button"
              @click="addAnswer()"
              class="flex items-center text-sm py-1 px-4 rounded-sm text-white bg-gray-600 hover:bg-gray-700"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4"
                viewBox="0 0 20 20"
                fill="currentColor"
              >
                <path
                  fill-rule="evenodd"
                  d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                  clip-rule="evenodd"
                />
              </svg>
              Добавить
            </button>
            <!--/ Add new question -->
          </h3>
          <div v-if="!model.answers.length" class="text-center text-gray-600">
            Вы еще не добавили ответы
          </div>
          <div v-for="(answer, index) in model.answers" :key="answer">
            <QuestionEditor
              :answer="answer"
              :index="index"
              @change="answerChange"
              @deleteAnswer="deleteAnswer"
            />
          </div>
        </div>

        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
          <TButton>
            <SaveIcon class="w-5 h-5 mr-2" />
            Добавить
          </TButton>
        </div>
      </div>
    </form>
  </PageComponent>
</template>

<script setup>
import { v4 as uuidv4 } from "uuid";
import { computed, ref, watch } from "vue";
import { useRoute, useRouter } from "vue-router";
import { SaveIcon, TrashIcon, ExternalLinkIcon } from '@heroicons/vue/solid'
import store from "../store";
import PageComponent from "../components/PageComponent.vue";
import QuestionEditor from "../components/editor/QuestionEditor.vue";
import TButton from "../components/core/TButton.vue";
import Alert from "../components/Alert.vue";

const router = useRouter();
const route = useRoute();

store.dispatch("getCategories");

// Get survey loading state, which only changes when we fetch survey from backend
const surveyLoading = computed(() => store.state.currentSurvey.loading);
const categories = computed(() => store.state.categories);

// Create empty survey
let model = ref({
  title: "",
  slug: "",
  status: false,
  availability:true,
  description: null,
  image: null,
  image_url: null,
  expire_date: null,
  category_id: null,
  answers: [],
});

let errorMsg = ref("");

watch(
  () => store.state.currentSurvey.data,
  (newVal, oldVal) => {
    model.value = {
      ...JSON.parse(JSON.stringify(newVal)),
      status: !!newVal.status,
    };
  }
);

// If the current component is rendered on survey update route we make a request to fetch survey
if (route.params.id) {
  store.dispatch("getSurvey", route.params.id);
}

function onImageChoose(ev) {
  const file = ev.target.files[0];

  const reader = new FileReader();
  reader.onload = () => {
    // The field to send on backend and apply validations
    model.value.image = reader.result;

    // The field to display here
    model.value.image_url = reader.result;
    ev.target.value = "";
  };
  reader.readAsDataURL(file);
}

function addAnswer(index) {
  const newAnswer = {
    id: uuidv4(),
    answer: "",
    count: 0,
   // data: {},
  };

  model.value.answers.push(newAnswer);
}

function deleteAnswer(answer) {
  model.value.answers = model.value.answers.filter((q) => q !== answer);
}

function answerChange(answer) {
  // Important to explicitelly assign question.data.options, because otherwise it is a Proxy object
  // and it is lost in JSON.stringify()
  model.value.answers = model.value.answers.map((q) => {
    // console.log(JSON.parse(JSON.stringify(answer)));
    // console.log(q);
    if (q.id === answer.id) {
      return JSON.parse(JSON.stringify(answer));
    }
    return q;
  });
}

/**
 * Create or update survey
 */
function saveSurvey() {
  let action = "created";
    if (model.value.answers.length===0) {
        errorMsg.value = {answers: 'Добавьте варианты ответов'}
        return
    }
    console.log(model.value);
  store.dispatch("saveSurvey", { ...model.value }).then(({ data }) => {
    store.commit("notify", {
      type: "success",
      message: "Опрос успешно добавлен",
    });
    router.push({
      name: "Surveys",
    });
  }).catch((err) => {
      store.commit("notify", {
          type: "error",
          message: "Ошибка!",
      });
      errorMsg.value = err.response.data.message;
  });
}

function deleteSurvey() {
  if (
    confirm(
      `Are you sure you want to delete this survey? Operation can't be undone!!`
    )
  ) {
    store.dispatch("deleteSurvey", model.value.id).then(() => {
      router.push({
        name: "Surveys",
      });
    });
  }
}
</script>

<style></style>
