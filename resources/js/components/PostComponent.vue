<template>
    <div>
        <h1 class="text-center">{{ category.name }} ヒント追加</h1>

        <div class="text-end">
            <a class="btn btn-dark" href="/">ホーム</a>
            <a class="btn btn-dark" :href="'/game/' + category.id">ゲーム</a>
        </div>

        <form :action="'/post/' + category.id" method="post" class="text-center">
           
            <div>
                <label for="choice">選択肢</label>
                <select name="choice_id" id="choice">
                    <option v-for="choice in choices" :key="choice.id" :value="choice.id">{{ choice.text }}</option>
                </select>
            </div>
           
            <div>
                <label for="question">質問</label>
                <select name="question_id" id="question">
                    <option v-for="question in questions" :key="question.id" :value="question.id">{{ question.text }}</option>
                </select>
            </div>
            
            <div>
                <label for="answer">回答</label>
                <select name="answer_text" id="answer">
                    <option value="はい">はい</option>
                    <option value="どちらかといえばはい">どちらかといえばはい</option>
                    <option value="どちらともいえない">どちらともいえない</option>
                    <option value="どちらかといえばいいえ">どちらかといえばいいえ</option>
                    <option value="いいえ">いいえ</option>
                </select>
            </div>

            <input class="btn btn-dark" type="submit" value="送信">
            <input type="hidden" name="_token" :value="csrf">
            
        </form>
    </div>

</template>

<script>
    export default {
        props: {
            category: {
                type: Object,
                required: true
            },
            questions: {
                type: Array,
                required: true
            },
            choices: {
                type: Array,
                required: true
            }
        },
        data() {
            return{
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }
    }
</script>

<style scoped>

</style>