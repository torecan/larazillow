<template>
    <form>
        <div class="mb-4 mt-4 flex flex-wrap gap-4">
            <div class="flex flex-nowrap items-center gap-2">
                <input id="deleted"
                       type="checkbox"
                       v-model="filterForm.deleted" class="h-4 w-4 rounded-md border-gray-300 text-indigo-600 focus:ring-indigo-500">
                <label for="deleted">Deleted</label>
            </div>
            <div>
                <select v-model="filterForm.by" class="input-filter-l w-28">
                    <option value="created_at">Release</option>
                    <option value="price">Price</option>
                </select>
                <select v-model="filterForm.order" class="input-filter-r w-32">
                     <option v-for="sortOptions in sortOptions"
                             :key="sortOptions.value" :value="sortOptions.value">
                         {{ sortOptions.label }}
                     </option>
                </select>
            </div>
        </div>
    </form>

</template>

<script setup>

// import {useForm} from "@inertiajs/vue3";
//
// const filterForm = useForm({
//     deleted: false,
// })

import { reactive, watch, computed } from "vue";
import { router } from '@inertiajs/vue3';
import { debounce } from "lodash";


const props = defineProps({
    filters: Object,
})

const sortLabels = {
    created_at: [
        {
            label: 'Latest',
            value: 'desc',
       },
       {
            label: 'Oldest',
            value: 'asc',
       }
    ],
    price: [
        {
            label: 'Pricey',
            value: 'desc'
        },
        {
            label: 'Cheapest',
            value: 'asc'
        }
    ]
}

const sortOptions = computed(() => sortLabels[filterForm.by])

const filterForm = reactive({
    deleted: props.filters.deleted ?? false,
    by: props.filters.delete ?? 'created_at',
    order: props.filters.order ?? 'desc'
})


// watch(
//     filterForm,
//     (newValu, oldV) => console.log("Chagneeee"),
//     )

// watch(
//     filterForm, () => router.get(
//         route('realtor.listing.index'),
//         filterForm,
//         {preserveState: true, preserveScroll: true},
//     ),
// )

watch(
    filterForm, debounce(() =>
        router.get(
        route('realtor.listing.index'),
        filterForm,
        {preserveState: true, preserveScroll: true},
    ), 1000)
)


</script>
