<template>

        <p>This is the Main page and our content</p>   
        <br>
        <br>
        <p>this is the time: {{ currentDateTime }}</p> 
        <p>message: {{ message }}</p>     
</template>
<script setup>
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