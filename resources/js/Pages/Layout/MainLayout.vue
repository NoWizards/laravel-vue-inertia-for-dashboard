<template>
    <div class="header">
        <h1>this is the header {{ timer }}</h1>
        <nav>
            <Link href="/" class="links">Index</Link>
            <Link href="/about" class="links">About</Link>
        </nav>
    </div>
    <div class="container">
        <slot></slot>
    </div>
</template>
<script setup>
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';
const timer = ref(0);
setInterval(() => {
    timer.value++;
}, 1000);

</script>
<style scoped>
.links{
    margin-right:8px;
}
</style>