<template>
    <div class="container">


    <h2>Create a new House to list</h2>
    <form @submit.prevent="create">
      <div>
        <div>
          <label>Beds</label>
          <input v-model.number="form.beds" type="text" />
        </div>
  
        <div>
          <label>Baths</label>
          <input v-model.number="form.baths" type="text" />
        </div>
  
        <div>
          <label>Area</label>
          <input v-model.number="form.area" type="text" />
        </div>
  
        <div>
          <label>City</label>
          <input v-model="form.city" type="text" />
        </div>
  
        <div>
          <label>Post Code</label>
          <input v-model="form.code" type="text" />
        </div>
  
        <div>
          <label>Street</label>
          <input v-model="form.street" type="text" />
        </div>
  
        <div>
          <label>Street Nr</label>
          <input v-model.number="form.street_nr" type="text" />
        </div>
  
        <div>
          <label>Price</label>
          <input v-model.number="form.price" type="text" />
        </div>
  
        <div class="flex items-center justify-end mt-4">
          <button type="submit">Create</button>
        </div>
      </div>
    </form>
    </div>
  </template>
  
  <script setup>
  import { useForm } from '@inertiajs/vue3'
  
  const form = useForm({
    beds: 0,
    baths: 0,
    area: 0,
    city: null,
    street: null,
    code: null,
    street_nr: null,
    price: 0,
  })
  const create = () => form.post('/listings')
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
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    transition: background-color 0.3s ease;
  }
  button:hover {
    background-color: #45a049;
  }
  </style>