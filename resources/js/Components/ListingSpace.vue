<template>
    <div class="font-bold text-sm">
       <span class="font-bold">{{ listing.beds }} bds </span><span class="text-gray-400"> |</span> &nbsp;
       <span class="font-bold">{{ listing.baths }} ba </span><span class="text-gray-400"> |</span> &nbsp;
       <span class="font-bold">{{ listing.area }} m” </span>
    </div>
</template>

<script setup>
defineProps({
    listing: Object,
})

</script>

