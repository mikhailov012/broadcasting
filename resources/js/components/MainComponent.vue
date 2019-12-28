<template>

    <div>
        <div class="container">

            <h5>Чат</h5>

            <div class="messages">

                <template v-if="messages.length">
                    <template v-for="msg in messages">
                        <div class="message">
                            {{msg}}
                        </div>
                    </template>
                </template>
                <template v-else>
                    <div><b>Нет сообщений</b></div>
                </template>

            </div>

            <div class="chat-form">

                <h5>Введите сообщение</h5>

                <div class="chat-form-block">
                    <div class="form-group">
                        <textarea class="form-control" @input="updMsg">{{message}}</textarea>
                    </div>
                </div>

                <div class="chat-bot-buttons">
                    <div class="btn btn-info" @click="sendMessage">Отправить</div>
                </div>

            </div>

        </div>
    </div>

</template>

<script>

    import {mapState, mapActions, mapMutations, mapGetters} from 'vuex'

    export default {
        name: "MainComponent",
        components: {},
        data() {
            return {
                wait: false
            }
        },
        computed: {
            ...mapState([
                'message',
                'user',
                'users',
                'messages'
            ])
        },
        methods: {
            ...mapMutations([
                'updateUsers',
                'addUser',
                'removeUser',
                'updateMessage',
                'addMessageToList'
            ]),

            ...mapActions([
                'SEND_MESSAGE'
            ]),

            sendMessage() {
                if (!this.wait) {
                    this.wait = true

                    this.SEND_MESSAGE()
                        .then((response) => {
                            this.updateMessage(null)
                        })
                        .catch((error) => {
                            console.log(error)
                        })
                        .finally(() => {
                            this.wait = false
                        })
                }
            },

            updMsg(e) {
                this.updateMessage(e.target.value)
            }
        },
        watch: {},
        created() {

            console.log('created')

        },
        mounted() {
            console.log('mounted')

            let self = this

            Echo.join('chat')
                .here((users) => {
                    console.log('here')
                    self.updateUsers(users)
                })
                .joining((user) => {
                    console.log('joining')
                    self.addUser(user)
                })
                .leaving((user) => {
                    console.log('leaving')
                    self.removeUser(user)
                })
                .listen('ChatMessage', (r) => {
                    console.log('listen ChatMessage')
                    console.log(r)
                    this.addMessageToList(r.message)
                })
                .notification((n) => {
                    console.log(n)
                })
                .listenForWhisper('typing', (r) => {
                    console.log(r)
                })
        }
    }
</script>

<style type="text/scss">
    .messages, .chat-form {
        width: 100%;
        height: calc(50vh - 105px);
    }

    .messages {
        .message {
            margin-bottom: 10px;

            &:last-child {
                margin-bottom: 0;
            }
        }
    }
</style>
