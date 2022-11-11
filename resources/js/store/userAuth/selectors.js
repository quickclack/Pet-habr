export const getIsAuth = (state) => state.auth.user == null;

export const getUser = (state) => state.auth.user;

export const getToken = (state) => state.auth.user !== null ? state.auth.user.token: '';

export const getErrors = (state) => state.auth.errors;