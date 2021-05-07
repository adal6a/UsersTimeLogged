import axios from "axios";

let instance = axios.create({
    baseURL: 'http://localhost:8000',
    withCredentials: true,
});

export default instance;