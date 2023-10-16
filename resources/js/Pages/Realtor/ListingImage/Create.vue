<template>
    <Box>
        <template #header>Upload Images</template>
        <form @submit.prevent="upload">
            <section class="flex items-center gap-2 my-4">
                <input
                    class="border rounded-md file:px-4 file:py-2 border-gray-200 file:text-gray-700
                        file:bg-gray-100 file:hover:bg-gray-200 file:border-0 file:font-medium file:hover:cursor-pointer file-mr-4
                      "
                    type="file" multiple @input="addFiles"/>
                <button type="submit" class="btn-outline disabled:opacity-25" :disabled="!canUpload" >Upload</button>
                <button type="reset" class="btn-outline" @click="reset">Reset</button>
            </section>
        </form>
    </Box>
</template>

<script setup>

import Box from "@/Components/UI/Box.vue";
import {useForm} from "@inertiajs/vue3";
import {computed} from "vue";
import NProgress from 'nprogress'
import { Inertia } from '@inertiajs/inertia'

const props = defineProps({
    listing: Object
})

Inertia.on('progress', (event) => {
    if (event.detail.progress.percentage) {
        NProgress.set((event.detail.progress.percentage / 100) * 0.9)
    }
})

const form = useForm({
   images: []
});


const canUpload = computed(
    () => form.images.length
)

const upload = () => {
    form.post(
        route('realtor.listing.image.store', {listing: props.listing.id}),
        {
            onSuccess: () => {
                form.images = []
            }
        }
    )
}

const addFiles = (event) => {
    for (const image of event.target.files) {
        form.images.push(image);
    }
}

const reset = () => form.images = [];


</script>
