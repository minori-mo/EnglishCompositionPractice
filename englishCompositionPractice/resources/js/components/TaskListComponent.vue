<template>
    <Main class="m-auto w-75 text-center">
        <form action='/main' method="post">
            <input type="hidden" name="_token" :value="csrf">
            <div class="selectLevelArea" v-show="isShowLevel">
                <label v-for="item in levelArray" class="btn btn-secondary" v-on:click="">
                    <input type="radio" v-on:click="levelSelect(item.level)" class="btn-check" name="level" v-bind:value="item.level">中学{{item.level}}年
                </label>
            </div>
            <div class="selectQuantityArea" v-show="isShowQuantity">
                <label v-for="quantity in quantitys" class="btn btn-secondary">
                    <input type="radio" v-on:click="quantitySelect(quantity)" class="btn-check" name="quantity" v-bind:value="quantity">{{quantity}}
                </label>
            </div>
            <input type="submit" class="btn btn-primary" value="開始" v-show="isShowStartBtn">
        </form>
        <div class="mainArea" v-show="isShowSentences" >
            <p>
                {{ japanese }}
            </p>
            <p>
                {{ english }}
            </p>
            <button class="btn btn-secondary btn-lg mt-5" v-show="isShowDisplayBtn" v-on:click="displayBtn">英文表示</button>
            <div class="" v-show="!isShowDisplayBtn">
                <button class="btn btn-secondary btn-lg mt-5" v-on:click="displayBtn" value="〇">〇</button>
                <button class="btn btn-secondary btn-lg mt-5" v-on:click="displayBtn" value="✕">✕</button>
            </div>
            <button class="btn btn-secondary btn-lg mt-5" v-show="isShowResultBtn">結果表示</button>
        </div>
        <div class="resultArea" v-show="isShowResult">
        ここに結果を表示
        </div>
    </Main>
</template>

<script>
    let sentences = []
    let sentenceCount = 0
    let isJapaneseDisplay = true
    let sentenceLevel = null

    export default {
        data: function() {
            return {        
                english: '',
                japanese: '',
                isShowLevel: true,
                isShowQuantity: false,
                isShowStartBtn: false,
                isShowSentences: false,
                isShowDisplayBtn: true,
                isShowResultBtn: false,
                isShowResult: false,
                //TODO　allでSQLで全権取得
                quantitys:["10","20","30","all"],
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        },
        props: [
            "levelArray",
            "sentenceArray"
        ],
        mounted : function(){
            //センテンスが存在する場合はメインエリア表示
            if (this.sentenceArray.length !== 0){
                this.isShowSentences = true

                //第一問目の日本語を表示
                this.japanese = this.sentenceArray[0].JAPANESE
            }
        },
        methods: {
            displayBtn: function (e) {
                if ( sentenceCount !== this.sentenceArray.length ){
                    if (isJapaneseDisplay) {
                        this.english = this.sentenceArray[sentenceCount].ENGLISH
                        this.isShowDisplayBtn = false
                        isJapaneseDisplay = false
                        sentenceCount++
                    } else if (!isJapaneseDisplay) {
                        this.japanese = this.sentenceArray[sentenceCount].JAPANESE
                        this.english = ''
                        this.isShowDisplayBtn = true
                        isJapaneseDisplay = true
                    }                    
                } else {
                    this.japanese = ''
                    this.english = '終了'
                    // sentenceCount = 0
                    this.isShowResultBtn = true
                }
            },
            levelSelect: function (level) {
                this.isShowLevel = false
                this.isShowQuantity = true
            },
            quantitySelect: function (quantity) {
                this.isShowQuantity = false
                this.isShowStartBtn = true
            }
        }
    }
    //中一、中二、中三を選ぶ
        //選んだら非表示、センテンス数を表示
    //表示するセンテンスの数を選べる
        //センテンス数は5，10，20，50,全データ
        //数を選んだら非表示
    
    //DBから選んだセンテンスをランダム取得
    //カウントダウン開始    
    //カウントスタート
    //一問目の英語を表示
    //次へボタンで日本語訳表示
    //次へボタンで次の英語を表示
    //最終問題終了でタイムリザルト画面を表示
</script>
</html>