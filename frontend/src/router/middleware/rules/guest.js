import store from '../../../store';

export default (to, from, next) => {
    if (store.getters['tokenAuthentication'] !== null) {
        next({ name: 'users' });
    } else {
        next();
    }
}