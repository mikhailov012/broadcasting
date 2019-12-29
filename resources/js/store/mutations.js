export default {
    updateUsers(state, users) {
        state.users = users
    },

    addUser(state, user) {
        state.users.push(user)
    },

    removeUser(state, user) {

        let users = state.users;

        _.remove(users, (u, i) => {
            return u.id === user.id
        })

        state.users = users
    },

    updateMessage(state, message) {
        state.message = message
    },

    addMessageToList(state, data) {
        state.messages.push({name: data.name, message: data.message})
    }
}
