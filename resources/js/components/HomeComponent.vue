<template>
    <div>
        <h1 class="text-center">ヒントクイズ</h1>
        <div v-for="category in categories" :key="category.id" class="d-inline-flex flex-wrap mt-3">
            <a class="btn btn-primary me-1" :href="'/game/'+ category.id">{{ category.name }}</a>

        </div>

    </div>
   
</template>

<script>
    export default {
        props: {
            categories: {
                type: Array,
                required: true
            }
        }
    }
</script>

<style scoped>

</style>