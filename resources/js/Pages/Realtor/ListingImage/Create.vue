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
            <div v-if="uploadErrors.length">
                <div v-for="(error, index) in uploadErrors" class="error" :key="index"> {{ error }} </div>
            </div>
        </form>
    </Box>

    <Box v-if="listing.images.length" class="mt-4">
        <template #header>Current Images</template>
        <section class="mt-4 grid grid-cols-3 gap-2">
            <div v-for="image in listing.images">
                <div class="flex flex-col justify-between gap-2">
                    <img :src="image.src" class="rounded-md">
                    <Link :href="route('realtor.listing.image.destroy', {
                        listing: props.listing.id,
                        image: image.id
                    })"
                    class="btn-outline text-xs"
                    as="button"
                    method="delete"
                    >Delete</Link>
                </div>
            </div>
        </section>
    </Box>
</template>

<script setup>

import Box from "@/Components/UI/Box.vue";
import {useForm} from "@inertiajs/vue3";
import {computed} from "vue";
import NProgress from 'nprogress'
import { Link, Inertia } from '@inertiajs/inertia'

const props = defineProps({
    listing: Object
})

Inertia.on('progress', (event) => {
    if (event.detail.progress.percentage) {
        NProgress.set((event.detail.progress.percentage / 100) * 0.9)
    }
})

const uploadErrors = computed( () => Object.values(form.errors));

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
