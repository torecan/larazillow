<template>

    <form @submit.prevent="login">
        <div class="w-1/2 mx-auto">
            <div>
                <label for="email" class="label">E-mail</label>
                <input id="email" type="text" class="input" v-model="form.email">
                <div class="error" v-if="form.errors.email">{{ form.errors.email }}</div>
            </div>
            <div class="mt-4">
                <label for="password" class="label">Password</label>
                <input id="password" type="password" v-model="form.password" class="input">
                <div class="error" v-if="form.errors.password">{{ form.errors.password }}</div>
            </div>
            <div class="mt-4 text-center">
                <button class="button w-full" type="submit">Login</button>
                <Link :href="route('user-account.create')" class="text-sm text-gray-500 ">
                    Need an account? Click here
                </Link>
            </div>
        </div>

    </form>
</template>

<script setup>

import { useForm, Link } from "@inertiajs/vue3";

const form = useForm({
    email: null,
    password: null,
})

const login = () => form.post(route('login.store'))

</script>
