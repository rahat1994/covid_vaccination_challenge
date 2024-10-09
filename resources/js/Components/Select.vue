<script setup>
import { onMounted, defineProps, ref } from 'vue';

const props = defineProps({
    options: {
        type: Array,
        required: true
    },
    modelValue: {
        type: String,
        required: true
    }
});

defineEmits(['update:modelValue']);

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <select
        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    >
        <option value="" disabled>Select a vaccine center</option>
        <option v-for="option in options" :key="option.id" :value="option.id">
            {{ option.name }}
        </option>
    </select>
</template>
