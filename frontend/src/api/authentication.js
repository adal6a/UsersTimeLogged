import request from "./request";

export default {
    createSession() {
        return request.get('/sanctum/csrf-cookie');
    },

    login(params) {
        return request.post('/api/v1/login', params);
    },

    logout() {
        return request.get('/api/v1/logout');
    }
};
