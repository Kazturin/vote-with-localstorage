<template>
    <PageComponent title="Опрос">
        <template v-slot:header>
            <TButton color="green" :to="{ name: 'SurveyCreate' }">
                <PlusIcon class="w-5 h-5" />
                Добавить
            </TButton>
        </template>
        <div v-if="loading" class="flex justify-center">Loading...</div>
        <div v-else-if="survey && user.ip">
            <div class="flex items-center">
                <div class="w-96">
                    <SurveyListItem
                        :survey="survey"
                        class="animate-fade-in-down"
                        :voted = "survey.vote_ip.includes(user.ip)"
                        :userIp = user.ip
                    />
                </div>
            </div>
        </div>
        <div v-else class="text-gray-600 text-center py-16">
           Не найдено
        </div>
        <div class="my-4">
            <div class="flex justify-between">
                <h3 class="text-xl text-gray-500 border-gray-300 border-b py-4">Другие опросы</h3>
                <router-link :to="{name:'Surveys'}">
                    <chevron-right-icon class="h-6 w-6"/>
                </router-link>
            </div>
            <div v-if="surveys.length>0" class="mt-4 grid grid-cols-1 gap-5 sm:grid-cols-2 md:grid-cols-3">
                <SurveyListItem
                    v-for="item in surveys"
                    :key="item.id"
                    :survey="item"
                    class="animate-fade-in-down"
                    :voted = "item.vote_ip.includes(user.ip)"
                    :userIp = user.ip
                />
            </div>
            <div v-else>
                Не найдено ...
            </div>
        </div>
    </PageComponent>

</template>

<script setup>
import { computed, ref } from "vue";
import { useRoute } from "vue-router";
import { useStore } from "vuex";
import PageComponent from "../components/PageComponent.vue";
import {PlusIcon} from "@heroicons/vue/solid"
import TButton from '../components/core/TButton.vue'
import SurveyListItem from "../components/SurveyListItem.vue";
import { ChevronRightIcon } from "@heroicons/vue/outline";

const route = useRoute();
const store = useStore();

store.dispatch("getIp");
store.dispatch("getSurvey", route.params.id);
store.dispatch("getSurveysPublic");

const user = computed(() => store.state.user);
const loading = computed(() => store.state.currentSurvey.loading);
const survey = computed(() => store.state.currentSurvey.data);
const surveys = computed(() => store.state.surveysPublic.data.filter(item=>{
    return item.id!=route.params.id
}).slice(0,3))


</script>

<style scoped>

</style>
