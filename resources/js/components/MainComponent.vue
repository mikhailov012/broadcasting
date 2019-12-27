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

        },
        mounted() {
            Echo.channel('spooortx')
                .listen('matchStarted', (e) => {
                    console.log(e)
                })
        }
    }
</script>

<style scoped>

</style>
