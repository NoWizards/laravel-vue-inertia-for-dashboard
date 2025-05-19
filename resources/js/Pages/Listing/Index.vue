<template>
    <div v-for="listing in listings" :key="listing.id" class="flex gap-2 mx-2 my-1">
        <Link :href="`/listings/${listing.id}`">
            <ListingAddress :listing="listing" />
        </Link>
        <div>
            <Link :href="`/listings/${listing.id}/edit`" class="edit-button">Edit</Link>
        </div>
        <div>
            <Link :href="`/listings/${listing.id}`" method="DELETE" class="delete-button">Delete</Link>
        </div>
    </div>
</template>
<style scoped>
.edit-button {
    background-color: rgb(70, 163, 194);
    color: white;
    padding: 2px 6px;
    border-radius: 5px;
    text-decoration: none;
}
.delete-button {
    background-color: rgb(255, 0, 0);
    color: white;
    padding: 2px 6px;
    border-radius: 5px;
    text-decoration: none;
    cursor: pointer;
}
</style>  
  <script setup>
  import {Link} from '@inertiajs/vue3'
  import ListingAddress from '@/Components/ListingAddress.vue'
  defineProps({
    listings: Array,
  })
  </script>