<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <div class="hidden xs:block bg-main py-56 bg-cover mx-auto">
<!--        <img class="w-full" src="/main.jpg" alt="fon">-->
<div>
    <h1 class="text-4xl text-white text-center font-semibold">Опрос общественного мнения</h1>
        <div class="flex justify-center mt-6">
            <router-link :to="{name:'Surveys'}" class="p-2 bg-amber-500 shadow-lg text-white text-lg rounded mr-2">Опросы</router-link>
            <router-link :to="{name:'SurveyCreate'}" class="p-2 bg-amber-500 shadow-lg text-white text-lg rounded">Создать опрос</router-link>
        </div>
</div>
        
    </div>
    <div class="xs:hidden bg-main h-screen flex flex-col justify-center bg-cover mx-auto">
        <div class="-mt-20">
            <h1 class="text-4xl text-white text-center font-semibold">Опрос общественного мнения</h1>
        <div class="flex justify-center mt-6">
            <router-link :to="{name:'Surveys'}" class="p-2 bg-amber-500 shadow-lg text-white text-lg rounded mr-2">Опросы</router-link>
            <router-link :to="{name:'SurveyCreate'}" class="p-2 bg-amber-500 shadow-lg text-white text-lg rounded">Создать опрос</router-link>
        </div>
        </div>
<!--        <img class="w-full" src="/main.jpg" alt="fon">-->
        
    </div>
    <div class="bg-gradient-to-t from-slate-300 to-slate-50 ">
        <div class="max-w-7xl h-full mx-auto px-4 pt-6">
        <p class="mx-auto mt-12 px-2 text-center text-xl w-full lg:w-3/4 font-semibold text-gray-700">Использование интернет-голосований — это простой способ получать от аудитории мгновенные отзывы, касающиеся чего угодно.</p>
        <h1 class="text-center text-xl mt-6 p-6 border-gray-300 border-b">Несколько идей по использованию</h1>
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3 py-10">
            <div class="flex">
                <div class="w-14">
                    <LightBulbIcon class="w-14 h-14 text-yellow-500"/>
                </div>
                <div class="ml-2">
                   <h1 class="text-lg border-gray-300">Исследование рынка</h1>
                   <p class="text-sm">Собирайте мнения клиентов о новых товарах или услугах.</p>
               </div>
            </div>
            <div class="flex">
                <div class="w-14">
                    <LightBulbIcon class="w-14 h-14 text-yellow-500"/>
                </div>
                <div class="ml-2">
                   <h1 class="text-lg border-gray-300">Политические исследования</h1>
                   <p class="text-sm">Запускайте отслеживающие опросы, рейтинговые опросы в ходе предвыборных гонок и блиц-опросы на наиболее актуальные темы.</p>
               </div>
            </div>
            <div class="flex">
                <div class="w-14">
                   <LightBulbIcon class="w-14 h-14 text-yellow-500"/>
                </div>
                <div class="ml-2">
                   <h1 class="text-lg border-gray-300">Волонтерские организации</h1>
                   <p class="text-sm">Проводите опросы мнений для мобилизации волонтеров, получения ответов на приглашения на мероприятия и сбора информации с мест их проведения.</p>
               </div>
            </div>
            <div class="flex">
                <div class="w-14">
                    <LightBulbIcon class="w-14 h-14 text-yellow-500"/>
                </div>
                <div class="ml-2">
                   <h1 class="text-lg border-gray-300">Туристический бизнес</h1>
                   <p class="text-sm">Проводите опросы мнений среди туристов, касающиеся пребывания в гостинице или организованного отдыха, чтобы отыскать пути усовершенствования их поездки.</p>
               </div>
            </div>
            <div class="flex">
                <div class="w-14">
                    <LightBulbIcon class="w-14 h-14 text-yellow-500"/>
                </div>
                <div class="ml-2">
                   <h1 class="text-lg border-gray-300">Технологии</h1>
                   <p class="text-sm">Mac или ПК? iPhone или Android? Портативный компьютер или настольный? Проведите среди друзей опрос мнений, касающийся любимых гаджетов, и он подскажет Вам идеи подарков на предстоящие дни рождения.</p>
               </div>
            </div>
            <div class="flex">
                <div class="w-14">
                   <LightBulbIcon class="w-14 h-14 text-yellow-500"/>
                </div>
                <div class="ml-2">
                   <h1 class="text-lg border-gray-300">Правительственные организации</h1>
                   <p class="text-sm">Государственные и правительственные учреждения могут быстро получать отзывы граждан, касающиеся предлагаемых изменений, и собирать рекомендации посредством онлайн-голосований.</p>
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
