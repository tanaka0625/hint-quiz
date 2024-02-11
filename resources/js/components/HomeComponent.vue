<template>
    <div>
        <h1>ヒントクイズ</h1>
        <div v-for="category in categories" :key="category.id">
            <a class="btn btn-primary" :href="'/game/'+ category.id">{{ category.name }}</a>

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