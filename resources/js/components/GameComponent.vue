<template>
    <div>
        <div>
            <h1>{{ category.name }}</h1>
        </div>

        <div v-if="status=='NG'">
            <h1>
                こちらのカテゴリーは回答数が不足しているため出題出来ません
            </h1>
        </div>

        <div v-if="status=='OK'">
            <div class="hints-wrapper">
                <div v-for="hint in hints" :key="hint['answer'].id">
                    <h2>{{ hint['question'].text }}</h2>
                    <h2>{{ hint['answer'].text }}</h2>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        props: {
            hints: {
                type: Array,
                required: true
            },
            category: {
                type: String,
                required: true
            },
            status: {
                type: String,
                required: true
            }
        }
    }
</script>

<style scoped>

</style>