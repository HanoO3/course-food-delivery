<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, usePage } from '@inertiajs/vue3'

const page = usePage()

defineProps({
    categories: {
        type: Array,
        required: true
    }
})
</script>

<template>
    <Head title="Restaurant Menu" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Restaurant Menu</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    
                    <!-- Success Message (just like your screenshot) -->
                    <div v-if="page.props.flash?.success" 
                         class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                        {{ page.props.flash.success }}
                    </div>

                    <!-- Error example (optional) -->
                    <div v-if="page.props.flash?.error" 
                         class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        {{ page.props.flash.error }}
                    </div>

                    <div v-if="can('category.create')" class="mb-6">
                        <Link class="btn btn-primary" :href="route('vendor.categories.create')">
                            Add New Product Category
                        </Link>
                    </div>

                    <div class="text-gray-900 overflow-x-scroll flex flex-col gap-8">
                        <div v-for="category in categories" :key="category.id" class="flex flex-col gap-4">
                            <div class="flex justify-between items-center">
                                <div class="text-2xl font-bold">{{ category.name }}</div>
                                <div class="flex gap-4 items-center">
                                    <Link :href="route('vendor.categories.edit', category)" 
                                          class="btn btn-secondary btn-sm">
                                        Edit
                                    </Link>
                                    <Link :href="route('vendor.categories.destroy', category)" 
                                          class="btn btn-danger btn-sm"
                                          method="delete"
                                          as="button">
                                        Delete
                                    </Link>
                                </div>
                            </div>

                            <div>
                                <Link class="btn btn-secondary btn-sm"
                                      :href="route('vendor.products.create', { category_id: category.id })">
                                    Add Product to {{ category.name }}
                                </Link>
                            </div>

                            <!-- Products list (your existing structure) -->
                            <div v-for="product in category.products" :key="product.id" class="ml-6 flex justify-between items-center py-2">
                                <div>
                                    {{ product.name }}
                                    <span class="text-gray-600 ml-2">{{ product.price.toFixed(2) }} €</span>
                                </div>
                                <div class="flex gap-3">
                                    <Link :href="route('vendor.products.edit', product)" 
                                          class="btn btn-secondary btn-sm">
                                        Edit
                                    </Link>
                                    <Link :href="route('vendor.products.destroy', product)" 
                                          class="btn btn-danger btn-sm"
                                          method="delete"
                                          as="button">
                                        Delete
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>