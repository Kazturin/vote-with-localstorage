<template>
  <!-- Question index -->
  <div class="flex items-center justify-between">
    <h3 class="text-lg font-bold">
      {{ index + 1 }}. {{ model.answers }}
    </h3>


    <div class="flex items-center">
      <!-- Delete question -->
      <button
        type="button"
        @click="deleteAnswer()"
        class="
          flex
          items-center
          text-xs
          py-1
          px-3
          rounded-sm
          border border-transparent
          text-red-500
          hover:border-red-600
        "
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-4 w-4"
          viewBox="0 0 20 20"
          fill="currentColor"
        >
          <path
            fill-rule="evenodd"
            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
            clip-rule="evenodd"
          />
        </svg>
        Удалить
      </button>
      <!--/ Delete question -->
    </div>
  </div>
  <!--/ Question index -->
  <div class="grid gap-3">
    <!-- Question -->
    <div class="mt-3">
      <label
        for="question_text"
        class="block text-sm font-medium text-gray-700"
        >Вариант:</label
      >
      <input
        type="text"
        name="question_text"
        v-model="model.answer"
        @change="dataChange"
        id="question_text"
        required
        class="
          mt-1
          focus:ring-indigo-500 focus:border-indigo-500
          block
          w-full
          shadow-sm
          sm:text-sm
          border-gray-300
          rounded-md
        "
      />
    </div>
    <!--/ Question -->

  </div>

  <!-- Data -->
  <div>

  </div>
  <!--/ Data -->

  <hr class="my-4" />
</template>

<script setup>
import { v4 as uuidv4 } from "uuid";
import { computed, ref } from "@vue/reactivity";
import store from "../../store";

const props = defineProps({
  answer: Object,
  index: Number,
});

const emit = defineEmits(["change", "addAnswer", "deleteAnswer"]);

// Re-create the whole question data to avoid unintentional reference change
const model = ref(JSON.parse(JSON.stringify(props.answer)));

function upperCaseFirst(str) {
  return str.charAt(0).toUpperCase() + str.slice(1);
}
// Emit the data change
function dataChange() {
  const data = model.value;

  emit("change", data);
}

function deleteAnswer() {
    console.log(props.answer);
  emit("deleteAnswer", props.answer);
}
</script>

<style></style>
