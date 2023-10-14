<template>

    <form @submit.prevent="register">
        <div class="w-1/2 mx-auto">
            <div>
                <label for="name" class="label">Name</label>
                <input id="name" type="text" class="input" v-model="form.name">
                <div class="error" v-if="form.errors.name">{{ form.errors.name }}</div>
            </div>
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
            <div class="mt-4">
                <label for="password_confirmation" class="label">Password Confirm</label>
                <input id="password_confirmation" type="password" v-model="form.password_confirmation" class="input">
                <div class="error" v-if="form.errors.password_confirmation">{{ form.errors.password_confirmation }}</div>
            </div>
            <div class="mt-4 text-center">
                <button class="button w-full" type="submit">Login</button>
                <Link :href="route('login')" class="text-sm text-gray-500">
                    Already have an account? Click here
                </Link>
            </div>
        </d

    </form>
</template>

<script setup>

import { useForm, Link } from "@inertiajs/vue3";

const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
})

const register = () => form.post(route('user-account.store'))

</script>
