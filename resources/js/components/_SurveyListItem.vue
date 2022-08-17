<template>
  <div
    class="flex flex-col py-4 px-6 shadow-md bg-white hover:bg-gray-50 h-[470px]"
  >
    <img
      :src="
        survey.image_url ||
        'https://st3.depositphotos.com/23594922/31822/v/600/depositphotos_318221368-stock-illustration-missing-picture-page-for-website.jpg'
      "
      :alt="survey.title"
      class="w-full h-48 object-cover position-top"
    />
    <h4 class="mt-4 text-lg font-bold">{{ survey.title }}</h4>
    <div class="overflow-hidden flex-1">
      <div v-for="answer in survey.answers" :key="answer.id">
        <div @click="emit('vote', answer.id)">
          {{answer.answer}}
        </div>
        Голоса: {{answer.count}}
      </div>
    </div>
    <div>

    </div>

    <div class="flex justify-between items-center mt-3">
      <div class="flex items-center">
        <TButton :href="`/view/survey/${survey.slug}`" circle link target="_blank">
          <ExternalLinkIcon class="w-5 h-5" />
        </TButton>

        <TButton v-if="survey.id" @click="emit('delete', survey)" circle link color="red">
          <TrashIcon class="w-5 h-5" />
        </TButton>
      </div>
    </div>
  </div>
</template>

<script setup>
import TButton from "./core/TButton.vue";
import { PencilIcon, ExternalLinkIcon, TrashIcon } from '@heroicons/vue/solid'

const { survey } = defineProps({
  survey: Object,
});
const emit = defineEmits(["delete", "edit","vote"]);
</script>

<style></style>
