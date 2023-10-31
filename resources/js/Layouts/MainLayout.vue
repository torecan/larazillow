<template>


    <header class="border-b border-gray-200">
        <div class="container mx-auto">
            <nav class="p-4 flex items-center justify-between">
                <div class="text-lg font-medium">
                    <Link :href="route('listing.index')">Properties</Link>
                </div>
                <div class="text-xl text-indigo-600 text-center font-bold">
                    <Link :href="route('listing.index')">PapaZillow</Link>
                </div>
                <div class="text-lg flex gap-4 items-center" v-if="user">
                    <Link
                        :href="route('notification.index')"
                        class="relative pr-2 py-2  text-lg">
                        🔔
                        <div v-if="notifications" class="absolute top-0 w-5 h-5 border border-white right-0 text-sm bg-red-700 text-white rounded-full text-center">
                            {{ notifications }}
                        </div>
                    </Link>
                    <Link :href="route('realtor.listing.index')" class="text-sm text-gray-500">{{ user.name }}</Link>
                    <Link :href="route('realtor.listing.create')" class="button">+ New Listing</Link>
                    <div>
                        <Link :href="route('logout')" method="DELETE" as="button">Sign-out</Link>
                    </div>
                </div>
                <div v-else>
                     <Link :href="route('login')">Sign In</Link>
                </div>
            </nav>
        </div>
    </header>

    <main class="container mx-auto p-4 w-full">
        <div v-if="success" class="mb-4 bg-green-300 border rounded-md shadow-sm border-green-400 p-2">{{ success }}</div>
        <slot>Default</slot>
    </main>
</template>

<script setup>
import {Link} from "@inertiajs/vue3";
import {computed, ref} from "vue";

import {usePage} from "@inertiajs/vue3";

const page = usePage()

const success = computed( () =>
    page.props.flash.success
)

const user = computed( () =>
    page.props.user
)

const notifications = computed(() =>
    Math.min(page.props.user.notificationCount, 9)
)
// const timer = ref(0)
// setInterval(() => timer.value++, 1000)

</script>
