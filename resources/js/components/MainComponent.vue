<template>

    <div>
        <div class="container">
            Main Component
        </div>
    </div>

</template>

<script>
    export default {
        name: "MainComponent",
        components: {},
        data() {
            return {

            }
        },
        computed: {},
        methods: {},
        watch: {},
        created() {

            console.log('created')

        },
        mounted() {
            console.log('mounted')

            // Echo.join('broadcasting')
            //     .here((users) => {
            //         console.log('here')
            //         console.log(users)
            //     })
            //     .joining((user) => {
            //         console.log('joining')
            //         console.log(user)
            //     })
            //     .leaving((user) => {
            //         console.log('leaving')
            //         console.log(user)
            //     })
            //     .listen('message_pushed', (e) => {
            //         console.log('listen message pushed')
            //         console.log(e)
            //     })
            //     .notification((e) => {
            //         console.log('notification')
            //         console.log(e)
            //     })

            Echo.join('chat')
                .here((users) => {
                    console.log('here')
                    console.log(users)
                })
                .joining((user) => {
                    console.log('joining')
                    console.log(user)
                })
                .leaving((user) => {
                    console.log('leaving')
                    console.log(user)
                })
                .listen('ChatMessage', (e) => {
                    console.log(e)
                })
        }
    }
</script>

<style scoped>

</style>
