<template>

    <div>
        <div class="container">

            <h5>Чат</h5>

            <div class="online-users">
                <div class="online-users-title">Online:</div>
                <div class="online-users-user" v-for="user in users">{{user.name}}</div>
            </div>

            <div class="messages">

                <template v-if="messages.length">
                    <template v-for="msg in messages">
                        <div class="message">
                            <b>{{msg.name}}:</b> {{msg.message}}
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
                        <!--<input class="form-control" @input="updMsg" :value="message">-->
                        <textarea class="form-control" @input="updMsg" @keydown="isTyping" @keyup="noTyping" @keyup.enter="sendMessage" :value="message"></textarea>
                    </div>
                    <div v-if="typing" style="margin-bottom: 10px">
                        {{typingUser}} печатает сообщение...
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
                wait: false,
                privateChannel: null,
                typingUser: null,
                typing: false,
                userName: null,
                userId: null
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
            },

            isTyping() {

                setTimeout(() => {
                    this.privateChannel
                        .whisper('typing', {
                            user: this.userName,
                            typing: true
                        })
                }, 300)

            },

            noTyping() {
                // setTimeout(() => {
                //     this.privateChannel
                //         .whisper('typing', {
                //             user: 'test',
                //             typing: false
                //         })
                // }, 300)
            }
        },
        watch: {},
        created() {

            console.log('created')

            let block = document.querySelector('#parent-main'),
                data = JSON.parse(block.dataset.userdata)

            if (data.id) {
                this.userId = data.id
            }

            if (data.name) {
                this.userName = data.name
            }

        },
        mounted() {
            console.log('mounted')

            this.privateChannel = Echo.private('chat')

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
                    this.$forceUpdate()
                })
                .listen('ChatMessage', (r) => {
                    console.log('listen ChatMessage')
                    console.log(r)
                    self.addMessageToList({name: r.name, message: r.message})
                })
                .notification((n) => {
                    console.log(n)
                })

            this.privateChannel
                .listenForWhisper('typing', (e) => {

                    let typingUser = e.user,
                        typing = e.typing

                    if (this.typingUser !== typingUser && this.typing !== typing) {
                        this.typingUser = e.user
                        this.typing = e.typing

                        setTimeout(() => {
                            this.typingUser = null
                            this.typing = false
                        }, 900)
                    }
                })
        }
    }
</script>

<style lang="scss">
    .messages, .chat-form {
        width: 100%;
        height: calc(50vh - 105px);
    }

    .online-users {
        display: flex;
        margin-bottom: 5px;

        &-title {
            font-weight: bold;
            margin-right: 10px;
        }

        &-user {
            margin-right: 5px;

            &:last-child {
                margin-right: 0;
            }
        }
    }

    .messages {
        .message {
            margin-bottom: 5px;

            &:last-child {
                margin-bottom: 0;
            }
        }
    }
</style>
