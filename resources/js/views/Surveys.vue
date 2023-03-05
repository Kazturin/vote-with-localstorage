<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <PageComponent :title="$t('nav.surveys')">

    <template v-slot:header>
      <div>
<!--        <h1 class="text-3xl font-bold text-gray-900">Опросы</h1>-->
        <TButton color="green" :to="{ name: 'SurveyCreate' }">
          <PlusIcon class="w-5 h-5" />
          {{ $t('add') }}
        </TButton>
      </div>
    </template>
      <div class="my-4 text-right">

          <label for="category" class="block text-lg font-medium text-gray-700">
              Категория
          </label>
          <div class="mt-1">
              <select class="w-40 form-select px-4 py-3 pr-8 rounded-md border-gray-300 focus:border-gray-400" @change="filter"
                      name="category_id"
                      id="category">
                  <option value="0">Новые</option>
                  <option v-for="category in categories" :key="category.id" :value="category.id">
                      {{category.name}}
                  </option>

              </select>
          </div>
      </div>
    <div v-if="surveys.data.loading" class="flex justify-center mt-8">
       <div class="w-12 h-12 rounded-full animate-spin
                    border-4 border-solid border-indigo-400 border-t-transparent"></div>
    </div>
    <div v-else-if="surveys.data.length>0">
      <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3">
        <SurveyListItem
          v-for="(survey, ind) in surveys.data"
          :key="survey.id"
          :survey="survey"
          class="animate-fade-in-down"
          :style="{ animationDelay: `${ind * 0.1}s` }"
          :voted = "votedSurveys.includes(survey.id)"
          @voting = "voting(survey.id)"
        />
      </div>
      <div class="flex justify-center mt-5">
        <nav
          class="relative z-0 inline-flex justify-center rounded-md shadow-sm -space-x-px"
          aria-label="Pagination"
        >
          <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
          <a
            v-for="(link, i) of surveys.links"
            :key="i"
            :disabled="!link.url"
            href="#"
            @click="getForPage($event, link)"
            aria-current="page"
            class="relative inline-flex items-center px-4 py-2 border text-sm font-medium whitespace-nowrap"
            :class="[
              link.active
                ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600'
                : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
              i === 0 ? 'rounded-l-md bg-gray-100 text-gray-700' : '',
              i === surveys.links.length - 1 ? 'rounded-r-md' : '',
            ]"
            v-html="link.label"
          >
          </a>
        </nav>
      </div>
    </div>
    <div v-else class="text-gray-600 text-center py-16">
        Еще нет опросов
    </div>
  </PageComponent>
</template>

<script setup>
import store from "../store";
import { computed,ref,reactive } from "vue";
import {PlusIcon} from "@heroicons/vue/solid"
import TButton from '../components/core/TButton.vue'
import PageComponent from "../components/PageComponent.vue";
import SurveyListItem from "../components/SurveyListItem.vue";

store.dispatch("getIp");
store.dispatch("getSurveysPublic");
store.dispatch("getCategories");


let surveys = computed(() => store.state.surveysPublic);
const user = computed(() => store.state.user);
const categories = computed(() => store.state.categories);

let votedSurveys = [];

const  colors = ['red','amber','sky','lime','indigo'];

 if (localStorage.getItem('votedSurveys')) {
     votedSurveys = JSON.parse(localStorage.getItem('votedSurveys'));
 }

function filter(ev){
    if(ev.target.value==='0'){
        store.dispatch("getSurveysPublic");
    }
    else{
        store.dispatch("getSurveysByCategoryId",ev.target.value);
    }
}

function voting(survey_id){
     if (survey_id){
         votedSurveys.push(survey_id);
         saveVote();
     }

}

function saveVote(){
    const parsed = JSON.stringify(votedSurveys);
    localStorage.setItem('votedSurveys', parsed);
}

function getForPage(ev, link) {
  ev.preventDefault();
  if (!link.url || link.active) {
    return;
  }
  store.dispatch("getSurveysPublic", { url: link.url });
}
</script>
