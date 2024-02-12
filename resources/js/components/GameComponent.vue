<template>
    <div>
        <div>
            <h1 class="text-center">{{ category.name }}</h1>
            <div class="text-end">
                <a class="btn btn-dark" href="/">ホーム</a>
                <a class="btn btn-dark" :href="'/post/' + category.id">ヒント追加</a>
            </div>
        </div>

        <div v-if="status=='NG'">
            <h1>
                こちらのカテゴリーはヒント数が不足しているため出題出来ません<br>
                右上のヒント追加ボタンからヒントの追加にご協力をお願いします
            </h1>
        </div>

        <div v-if="status=='OK'">
            <div class="text-left">回答可能回数: {{ answer_possible_cnt }}</div>
            <div class="hints-wrapper">
                <div v-for="(hint, index) in hints" :key="hint['answer'].id">
                    <div v-if="index < phase" class="bg-info">
                        <h3 :class="{'text-end': index%2==1}">Q:{{ hint['question'].text }}</h3>
                        <h3 :class="{'text-end': index%2==1}">A:{{ hint['answer'].text }}</h3>
                    </div>
                   
                </div>
            </div>

            <div class="text-center">
                <button class="btn btn-primary" v-on:click="show_hint()">ヒント</button>
            </div>

            <div class="choices-wrapper mt-5 text-center">
                <p>選択肢一覧</p>
                <div>
                    <select name="ch" v-model="submited_answer">
                        <option ref="answer" v-for="id in selected_choices" :key="id">{{ identyfy_choice(id).text }}</option>
                    </select>
                    <button class="btn btn-primary" v-if="this.answer_possible_cnt>0&&this.phase!=0" v-on:click="submit_answer()">回答</button>
                    <h2 v-if="this.answer_possible_cnt==0" class="mt-2">正解: <button class="btn btn-danger">{{ correct_choice.text }}</button></h2>
                </div>
                <div v-for="choice in choices" :key="choice.id" class="d-inline-flex flex-wrap mt-3">
                    <button class="btn btn-danger me-1" v-if="check_selected(choice.id)" v-on:click="click_choice(choice.id)">{{ choice.text }}</button>
                    <button class="btn btn-secondary me-1" v-if="!check_selected(choice.id)" v-on:click="click_choice(choice.id)">{{ choice.text }}</button>
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
                type: Object,
                required: true
            },
            status: {
                type: String,
                required: true
            },
            choices: {
                type: Array,
                required: true
            },
            correct_choice: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                answer_possible_cnt: 2,
                phase: 0,
                selected_choices: [],
                submited_answer: this.choices[0].text
            }
        },
        // 全選択肢を始めに選択状態にする
        created : function(){
            for(let i=0; i<this.choices.length; i++){
                this.selected_choices.push(this.choices[i].id);
            }
        },
        methods: {
            // ヒントを表示
            show_hint: function() {
                this.phase++;

                if(this.phase == 5 && this.answer_possible_cnt == 2)
                {
                    this.answer_possible_cnt--;
                }
            },
            // 選択肢をクリック
            click_choice: function(choice_id) {
                // 選択されていなかった場合
                if(!this.check_selected(choice_id)){
                    this.selected_choices.push(choice_id);

                }else{
                    // 選択されていた場合
                    this.selected_choices = this.selected_choices.filter(function(x){return x != choice_id});

                }
            },
            // 選択肢が現在選択されているかどうか
            check_selected: function(choice_id) {
                return this.selected_choices.includes(choice_id);
            },

            // choice_idから選択肢を特定
            identyfy_choice: function(choice_id) {
                for(let i=0; i<this.choices.length; i++) {
                    if(choice_id == this.choices[i].id) {
                        return this.choices[i];
                    }
                }
            },
            // 回答ボタン押したとき
            submit_answer: function(choice_id) {
                // 回答可能回数を1減らす
                this.answer_possible_cnt--;
                

                if(this.correct_choice.text == this.submited_answer) {
                    // 回答可能回数を0にすることで答えを表示する
                    this.answer_possible_cnt =0;
                }


            }

        }
    }
</script>

<style scoped>

</style>