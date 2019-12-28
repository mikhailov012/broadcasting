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

            Echo.private('broadcasting')
                .listen('MessagePushed', (e) => {
                    console.log(e)
                })

            // Echo.join('broadcasting')
            //     .here((users) => {
            //         console.log(users)
            //     })
            //     .joining((user) => {
            //         console.log(user)
            //     })
            //     .leaving((user) => {
            //         console.log(user)
            //     })

        },
        mounted() {

        }
    }
</script>

<style scoped>

</style>
