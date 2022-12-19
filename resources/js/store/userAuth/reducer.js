import { SIGNUP_USER, LOGIN_USER, LOGOUT_USER, SET_ERROR, AMOUNT_IN_USER} from "./actions"

const initialState = {
    user: {
        email: "",
        password: "",
        token: null,
        id: null,
        nickName : ''
    },
    errors: null,
    amount:{}
}

export const userAuthReducer = (state = initialState, {type, payload})=> {
    switch(type){
        case(SIGNUP_USER): {
            return {
                ...state,
                user:{...state.user, ...payload}
            }
        }
        case(LOGIN_USER): {
            return {
                ...state,
                user:{...state.user, ...payload}
            }
        }
        case(LOGOUT_USER): {
            return {
                ...state,
                user: {...state.user, token: null, id: null}
            }
        }
        case(SET_ERROR): {
            return {
                ...state,
                errors: payload
            }
        }
        case(AMOUNT_IN_USER):{
            return {
                ...state,
                amount: payload
            }
        }
        default : {
            return state
        }
    }
}