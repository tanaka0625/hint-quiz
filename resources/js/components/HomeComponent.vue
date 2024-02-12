<template>
    <div class="text-center">
        <h1 class="text-center">主観アキネータークイズ</h1>
        <p>あるジャンルの人、物が1つランダムに出題されます</p>
        <p>質問とそれに対する回答という形でヒントが出されます</p>
        <p>ヒントは5回まででます</p>
        <p>4回目のヒントまでは回答権が2回あります</p>
        <p>ヒント追加の御協力よろしくお願いします</p>
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