const tokenKey = 'token_auth'

export default {
    getToken() {
        return localStorage.getItem(tokenKey)
    },

    setToken(token) {
        return localStorage.setItem(tokenKey, token)
    },

    removeToken() {
        return localStorage.removeItem(tokenKey)
    }
}