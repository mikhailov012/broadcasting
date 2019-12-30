export default {
    updateUsers(state, users) {
        state.users = users
    },

    addUser(state, user) {
        state.users.push(user)
    },

    removeUser(state, user) {
        state.users = _.reject(state.users, (u) => {
            return u.id === user.id
        })
    },

    updateMessage(state, message) {
        state.message = message
    },

    addMessageToList(state, data) {
        state.messages.push({name: data.name, message: data.message})
    }
}
