<template>
        <p>This is the about page and our content</p>
        <p>dir: a test dir</p>
        <p>email: a test email</p>
  
</template>
<script setup>
import { Link } from '@inertiajs/vue3';

</script>
<script>
import MainLayout from '../Layout/MainLayout.vue';
export default{
    layout: MainLayout,
}
</script>