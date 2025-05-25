<template>
    <Box>
        <template #header>Upload New Images</template>
        <div v-if="progress > 0" class="w-full mt-2">
            <div class="h-2 bg-gray-200 rounded-full">
                <div
                class="h-2 bg-blue-500 rounded-full transition-all duration-200"
                :style="{ width: progress + '%' }"
                ></div>
            </div>
            <p class="text-sm text-gray-600 mt-1">{{ progress }}%</p>
        </div>
        <form @submit.prevent="upload">
            <section class="flex items-center gap-2 my-4">
                <input
                class="border rounded-md file:px-4 file:py-2 border-gray-200 dark:border-gray-700 file:text-gray-700 file:dark:text-gray-400 file:border-0 file:bg-gray-100 file:dark:bg-gray-800 file:font-medium file:hover:bg-gray-200 file:dark:hover:bg-gray-700 file:hover:cursor-pointer file:mr-4"
                type="file" multiple @input="addFiles"
                />
                <button
                type="submit"
                class="btn-outline disabled:opacity-25 disabled:cursor-not-allowed"
                :disabled="!canUpload"
                >
                Upload
            </button>
            <button
            type="reset" class="btn-outline"
            @click="reset"
            >
            Reset
        </button>
    </section>
    <div v-if="imageErrors.length" class="input-error">
        <div v-for="(error, index) in imageErrors" :key="index">
          {{ error }}
        </div>
      </div>
</form>
</Box>

<Box v-if="listing.images.length" class="mt-4">
    <template #header>Current Listing Images</template>
    <section class="mt-4 grid grid-cols-3 gap-4">
        <div
        v-for="image in listing.images" :key="image.id" 
        class="flex flex-col justify-between"
      >
        <img :src="image.src" class="rounded-md" />
        <Link 
          :href="route('realtor.listing.image.destroy', { listing: props.listing.id, image: image.id })"
          method="delete"
          as="button"
          class="mt-2 btn-outline text-xs"
        >
          Delete
        </Link>
        </div>
    </section>
  </Box>
</template>
  
<script setup>
import Box from '@/Components/UI/Box.vue'
import { Link } from '@inertiajs/vue3'
import { useForm } from '@inertiajs/vue3'
import { computed } from 'vue';
import { ref } from 'vue'


const props = defineProps({ listing: Object })
const progress = ref(0);
const imageErrors = computed(() => Object.values(form.errors))


const form = useForm({
  images: [],
})
const canUpload = computed(() => form.images.length)
const upload = () => {
    progress.value = 0
  form.post(
    route('realtor.listing.image.store', { listing: props.listing.id }),
    {
      onSuccess: () => {form.reset('images'); progress.value = 0},
      onError: () => {
        progress.value = 0
      },
      onProgress: (event) => {
        if (event) {
          progress.value = Math.round((event.loaded / event.total) * 100)
        }
      }
    },  
  )
}
const addFiles = (event) => {
  for (const image of event.target.files) {
    form.images.push(image)
  }
}
const reset = () => form.reset('images')
</script>