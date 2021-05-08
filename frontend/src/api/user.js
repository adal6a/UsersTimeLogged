import request from "./request";

export default {
    usersLoggedTime(params) {
        return request.get('/api/v1/users', {
            params
        });
    }
};