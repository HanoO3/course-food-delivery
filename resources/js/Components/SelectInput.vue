<script setup>
import { onMounted, ref } from 'vue'

defineProps({
  modelValue: {
    type: [String, Number, null],
    default: null
  },
  options: {
    type: Array,
    required: true
  },
  optionValue: {
    type: String,
    required: true
  },
  optionLabel: {
    type: String,
    required: true
  },
  defaultOption: Object
})

defineEmits(['update:modelValue'])

const input = ref(null)

onMounted(() => {
  if (input.value?.hasAttribute('autofocus')) {
    input.value.focus()
  }
})
</script>

<template>
  <select
    ref="input"
    class="border-gray-300 focus:border-primary-500 focus:ring-primary-500 rounded-md shadow-sm"
    :value="modelValue === null ? '' : modelValue"
    @change="
      $emit(
        'update:modelValue',
        $event.target.value === '' ? null : parseInt($event.target.value)
      )
    "
  >
    <option value="">
      {{ defaultOption?.[optionLabel] ?? 'Select option' }}
    </option>

    <option
      v-for="option in options"
      :key="option[optionValue]"
      :value="option[optionValue]"
    >
      {{ option[optionLabel] }}
    </option>
  </select>
</template>
