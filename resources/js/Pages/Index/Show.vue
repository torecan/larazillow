<template>
    hello {{ test.message }}
</template>


<script setup>

    const test = defineProps({
        message: String,
    })
</script>
