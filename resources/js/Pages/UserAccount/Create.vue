<template>
    <form @submit.prevent="register">
        <div class="w-1/2 mx-auto">
            <div>
                <label for="name" class="label">Your Name</label>
                <input type="text" id="name" v-model="form.name" class="input" />
                <div v-if="form.errors.name" class="input-error">{{ form.errors.name }}</div>
            </div>
            
            <div class="mt-4">
                <label for="email" class="label">Email</label>
                <input type="text" class="input" id="email" v-model="form.email" />
                <div v-if="form.errors.email" class="input-error">{{ form.errors.email }}</div>
            </div>
            <div class="mt-4">
                <label for="password" class="label">Password</label>
                <input type="password" class="input" id="password" v-model="form.password" />
                <div v-if="form.errors.password" class="input-error">{{ form.errors.password }}</div>
            </div>
            <div class="mt-4">
                <label for="password_confirmation" class="label">Confirm Password</label>
                <input type="password" class="input" id="password_confirmation" v-model="form.password_confirmation">
            </div>
            <div class="mt-4">
                <button class="btn-primary w-full">Create Account</button>
                <div class="mt-2 text-center">
                    <Link
                        :href="route('login')"
                        class="text-sm text-gray-500"
                    >
                        Already have an account? Click here
                    </Link>
                </div>
            </div>
        </div>
    </form>
</template>
<script setup>
import { useForm, Link } from '@inertiajs/vue3';

const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
})



const register = () => form.post(route('user-account.store'))

</script>