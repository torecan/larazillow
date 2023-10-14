<template>
    <Link v-for="(link, index) in links"
         :key="index"
          :href="link.url"
         v-html="link.label"
         class="py-2 px-4 rounded-md"
         :class="{'bg-indigo-500 text-gray-300': link.active}"
    >
    </Link>
</template>


<script setup>

import { Link } from "@inertiajs/vue3";

defineProps(
    {
        links: Array,
    }
)

</script>
