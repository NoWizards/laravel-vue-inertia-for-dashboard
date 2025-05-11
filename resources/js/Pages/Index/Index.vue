<template>

        <p>This is the Main page and our content</p>   
        <br>
        <br>
        <p>this is the time: {{ currentDateTime }}</p> 
        <p>message: {{ message }}</p>     
</template>
<script setup>
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';
defineProps({
    message: {
        type: String,
        default: 'Hello from the index page!'
    },
    anotherOne: {
        type: String,
        required: true
    }
});
const currentDateTime = ref(new Date().toLocaleString());
</script>
<script>
import MainLayout from '../Layout/MainLayout.vue';
export default{
    layout: MainLayout,
}
</script>