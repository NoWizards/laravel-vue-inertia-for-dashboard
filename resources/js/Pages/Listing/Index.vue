<template>
  <Filters :filters="filters" />
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
      <Listing v-for="listing in listings.data" :key="listing.id" :listing="listing" ></Listing>
    </div>
  <div v-if="listings.data.length" class="w-full flex justify-center mt-8 mb-8">
    <br>
    <Pagination :links="listings.links" />
    
   
    </div>
</template>
<style scoped>
</style>  
  <script setup>
  import Listing from '@/Components/Listing.vue';
  import Pagination from '@/Components/UI/Pagination.vue';
  import Filters from './Components/Filters.vue';
  defineProps({
    listings: Object,
    filters: Object,
  })
  </script>