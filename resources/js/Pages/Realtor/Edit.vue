<template>
    <div class="container">
        <h2>Update Info</h2>
    <form @submit.prevent="update">
        <div>
        <div>
            <label>Beds</label>
            <div class="flex justify-start ml-2 gap-2">
                <input v-model.number="form.beds" type="text" />
                <div v-if="form.errors.beds" class="text-red-500">
                {{ form.errors.beds }}
                </div>
            </div>
        </div>
  
        <div>
            <label>Baths</label>
            <div class="flex justify-start ml-2 gap-2">
                <input v-model.number="form.baths" type="text" />
                <div v-if="form.errors.baths" class="text-red-500">
                {{ form.errors.baths }}
                </div>
            </div>
        </div>
  
        <div>
            <label>Area</label>
            <div class="flex justify-start ml-2 gap-2">
                <input v-model.number="form.area" type="text" />
                <div v-if="form.errors.area" class="text-red-500">
                {{ form.errors.area }}
                </div>
            </div>
        </div>
  
        <div>
          <label>City</label>
            <div class="flex justify-start ml-2 gap-2">
                <input v-model="form.city" type="text" />
                <div v-if="form.errors.city" class="text-red-500">
                {{ form.errors.city }}
                </div>
            </div>
        </div>
  
        <div>
          <label>Post Code</label>
            <div class="flex justify-start ml-2 gap-2">
                <input v-model="form.code" type="text" />
                <div v-if="form.errors.code" class="text-red-500">
                {{ form.errors.code }}
                </div>
            </div>
        </div>
  
        <div>
          <label>Street</label>
            <div class="flex justify-start ml-2 gap-2">
                <input v-model="form.street" type="text" />
                <div v-if="form.errors.street" class="text-red-500">
                {{ form.errors.street }}
                </div>
            </div>
        </div>
  
        <div>
          <label>Street Nr</label>
            <div class="flex justify-start ml-2 gap-2">
                <input v-model="form.street_nr" type="text" />
                <div v-if="form.errors.street_nr" class="text-red-500">
                {{ form.errors.street_nr }}
                </div>
            </div>
        </div>
  
        <div>
          <label>Price</label>
            <div class="flex justify-start ml-2 gap-2">
                <input v-model.number="form.price" type="text" />
                <div v-if="form.errors.price" class="text-red-500">
                {{ form.errors.price }}
                </div>
            </div>
        </div>
  
        <div class="flex items-center justify-end mt-4">
          <button type="submit">Save Changes</button>
        </div>
      </div>
    </form>
    </div>
  </template>
  
  <script setup>
  import { useForm } from '@inertiajs/vue3'
  
  const props = defineProps({
    listing: Object,
  })
  const form = useForm({
    beds: props.listing.beds,
    baths: props.listing.baths,
    area: props.listing.area,
    city: props.listing.city,
    street: props.listing.street,
    code: props.listing.code,
    street_nr: props.listing.street_nr,
    price: props.listing.price,
  })
  const update = () => form.put(
  route('realtor.listing.update', { listing: props.listing.id }),
)
  </script>
  
  <style scoped>
  .container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  }
  h2 {
    text-align: center;
    margin-bottom: 20px;
  }
  input{
    border: solid 1px #777;
    border-radius: 4px;
    padding: 0px 6px
  }
  label {
    margin-right: 2em;
  }
  
  div {
    padding: 2px
  }
  button {
    background-color: #2783ad;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    transition: background-color 0.3s ease;
  }
  button:hover{
    background-color: #2e9ccf;

  }
    
  
  </style>