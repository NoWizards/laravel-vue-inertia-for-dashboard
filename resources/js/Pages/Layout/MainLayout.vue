<template>
<header class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 w-full">
    <div class="container mx-auto">
      <nav class="p-4 flex items-center justify-between">
        <div class="text-lg font-medium">
          <Link :href="route('listings.index')">Listings</Link>
        </div>
        <div class="text-xl text-indigo-600 dark:text-indigo-300 font-bold text-center">
          <Link :href="route('listings.index')">Wizzards Template</Link>
        </div>

        <div v-if="user" class="flex items-center gap-4">
            <div class="text-sm text-gray-500">{{ user.name }}</div>
            <div class="p-2 rounded-md bg-indigo-600 hover:bg-indigo-500 text-center btn-primary">
                <Link :href="route('listings.create')" class=" text-white font-medium text-center">+ New Listing</Link>
            </div>
            <div>
                <Link :href="route('logout')" method="post" as="button">Logout</Link>
            </div>
        </div>
        <div v-else class="flex items-center gap-2">
            <Link :href="route('user-account.create')">Register</Link>
            <Link :href="route('login')">Sign-In</Link>
        </div>
      </nav>
    </div>
  </header>
  
  <main class="container mx-auto p-4 w-full">
    <div v-if="flashSuccess" class="mb-4 border rounded-md shadow-sm border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900 p-2">
      {{ flashSuccess }}
    </div>
    <slot>Default</slot>
  </main>
</template>
<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import {  computed } from 'vue';
const page = usePage()
const flashSuccess = computed(
() => page.props.flash?.success,
)
const user = computed(
  () => page.props?.user,
)

</script>
<style scoped>
</style>