<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, usePage } from '@inertiajs/vue3'
 
defineProps({
  orders: {
    type: Array
  }
})



const page = usePage()

</script>
 
<template>
  <Head title="My Orders" />
 
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Orders</h2>
    </template>
 
   


    <div class="py-12">
            
      <!-- Green banner added here -->
      <div v-if="page.props.flash?.success" 
           class="max-w-2xl mx-auto sm:px-6 lg:px-8 mb-6">
        <div class="p-4 bg-green-50 border border-green-200 rounded-lg text-green-800 text-center font-medium">
          {{ page.props.flash.success }}
        </div>
      </div>

      
      <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900 overflow-x-scroll flex flex-col gap-8">
            <div v-for="order in orders" :key="order.id">
              <div class="flex items-center justify-between text-2xl font-bold">
                <div>Order #{{ order.id }}</div>
                <div>{{ (order.total / 100).toFixed(2) }} &euro;</div>
              </div>
 
              <div class="text-lg mb-6">{{ order.restaurant.name }}</div>
 
              <div
                v-for="product in order.products"
                :key="product.id"
                class="flex items-center justify-between border-b mb-2 pb-2"
              >
                <div>{{ product.name }}</div>
                <div>{{ (product.price / 100).toFixed(2) }} &euro;</div>
              </div>
              <div class="text-gray-500">
                {{ new Date(order.created_at).toLocaleDateString() }}
                {{ order.status }}
              </div>



<div 
  v-if="order.status?.toLowerCase().includes('pending')"
  class="mt-4 p-4 bg-yellow-50 border border-yellow-200 rounded-lg text-yellow-800 text-center font-medium"
>
  Order is pending approval.
</div>






            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>