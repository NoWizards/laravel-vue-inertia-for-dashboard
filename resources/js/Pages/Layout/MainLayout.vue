<template>
    <div class="header">
        <h1>this is the header {{ timer }}</h1>
        <nav>
            <Link href="/" class="links">Index</Link>
            <Link href="/about" class="links">About</Link>
            <Link href="/listings/create" class="links">Create</Link>
        </nav>
        <div v-if="flashSuccess" class="success">
            {{ flashSuccess }}
        </div>
    </div>
    <div class="container">
        <slot></slot>
    </div>
</template>
<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
const page = usePage()
const flashSuccess = computed(
() => page.props.flash?.success,
)
const timer = ref(0);
setInterval(() => {
    timer.value++;
}, 1000);

</script>
<style scoped>
.links{
    margin-right:8px;
}
.success {
    background-color: green;
    color: white;
  }
</style>