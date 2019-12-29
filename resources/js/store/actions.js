export default {
    SEND_MESSAGE({commit, state}) {

        return new Promise((resolve, reject) => {

            axios.post('/send-message', {message: state.message})
                .then((response) => {
                    let data = response.data

                    commit('addMessageToList', {name: 'You', message: data.message})
                    resolve(response)
                })
                .catch((error) => {
                    reject(error)
                })

        })

    }
}
