<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <div class="hidden xs:block bg-main py-56 bg-cover mx-auto">
<!--        <img class="w-full" src="/main.jpg" alt="fon">-->
<div>
    <h1 class="text-4xl text-white text-center font-semibold">{{$t('main.conduct_survey')}}</h1>
        <div class="flex justify-center mt-6">
            <router-link :to="{name:'Surveys'}" class="p-2 bg-amber-500 shadow-lg text-white text-lg rounded mr-2">{{$t('nav.surveys')}}</router-link>
            <router-link :to="{name:'SurveyCreate'}" class="p-2 bg-amber-500 shadow-lg text-white text-lg rounded">{{$t('create_survey')}}</router-link>
        </div>
</div>

    </div>
    <div class="xs:hidden bg-main h-screen flex flex-col justify-center bg-cover mx-auto">
        <div class="-mt-20">
            <h1 class="text-4xl text-white text-center font-semibold">{{$t('main.conduct_survey')}}</h1>
        <div class="flex justify-center mt-6">
            <router-link :to="{name:'Surveys'}" class="p-2 bg-amber-500 shadow-lg text-white text-lg rounded mr-2">{{$t('nav.surveys')}}</router-link>
            <router-link :to="{name:'SurveyCreate'}" class="p-2 bg-amber-500 shadow-lg text-white text-lg rounded">{{$t('create_survey')}}</router-link>
        </div>
        </div>
<!--        <img class="w-full" src="/main.jpg" alt="fon">-->

    </div>
    <div class="bg-gradient-to-t from-slate-300 to-slate-50 ">
        <div class="max-w-7xl h-full mx-auto px-4 pt-6">
        <p class="mx-auto mt-12 px-2 text-center text-xl w-full lg:w-3/4 font-semibold text-gray-700">{{$t('main.header')}}.</p>
        <h1 class="text-center text-xl mt-6 p-6 border-gray-300 border-b">{{$t('main.ideas')}}</h1>
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3 py-10">
            <div class="flex">
                <div class="w-14">
                    <LightBulbIcon class="w-14 h-14 text-yellow-500"/>
                </div>
                <div class="ml-2">
                   <h1 class="text-lg border-gray-300">{{$t('main.idea1_title')}}</h1>
                   <p class="text-sm">{{$t('main.idea1')}}</p>
               </div>
            </div>
            <div class="flex">
                <div class="w-14">
                    <LightBulbIcon class="w-14 h-14 text-yellow-500"/>
                </div>
                <div class="ml-2">
                   <h1 class="text-lg border-gray-300">{{$t('main.idea2_title')}}</h1>
                   <p class="text-sm">{{$t('main.idea2')}}</p>
               </div>
            </div>
            <div class="flex">
                <div class="w-14">
                   <LightBulbIcon class="w-14 h-14 text-yellow-500"/>
                </div>
                <div class="ml-2">
                   <h1 class="text-lg border-gray-300">{{$t('main.idea3_title')}}</h1>
                   <p class="text-sm">{{$t('main.idea3')}}</p>
               </div>
            </div>
            <div class="flex">
                <div class="w-14">
                    <LightBulbIcon class="w-14 h-14 text-yellow-500"/>
                </div>
                <div class="ml-2">
                   <h1 class="text-lg border-gray-300">{{$t('main.idea4_title')}}</h1>
                   <p class="text-sm">{{$t('main.idea4')}}</p>
               </div>
            </div>
            <div class="flex">
                <div class="w-14">
                    <LightBulbIcon class="w-14 h-14 text-yellow-500"/>
                </div>
                <div class="ml-2">
                   <h1 class="text-lg border-gray-300">{{$t('main.idea5_title')}}</h1>
                   <p class="text-sm">{{$t('main.idea5')}}.</p>
               </div>
            </div>
            <div class="flex">
                <div class="w-14">
                   <LightBulbIcon class="w-14 h-14 text-yellow-500"/>
                </div>
                <div class="ml-2">
                   <h1 class="text-lg border-gray-300">{{$t('main.idea6_title')}}</h1>
                   <p class="text-sm">{{$t('main.idea6')}}</p>
               </div>
            </div>
        </div>
    </div>
    </div>
    <div class="bg-gray-700 h-12">

    </div>
</template>

<script setup>
import PageComponent from "../components/PageComponent.vue";
import {LightBulbIcon} from "@heroicons/vue/solid"
import TButton from '../components/core/TButton.vue'

</script>
