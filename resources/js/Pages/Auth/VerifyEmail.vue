<template>
    <div>You need to verify your email address before you can continue.</div>
    <div>
        <Link :href="route('verification.send')" method="post" as="button"
        class="text-indigo-600 dark:text-indigo-400 font-medium hover:underline">
            Resend verification email</Link>
    </div>
</template>
<script setup>
import { Link } from '@inertiajs/vue3'
</script>