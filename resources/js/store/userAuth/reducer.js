import { SIGNUP_USER, LOGIN_USER, LOGOUT_USER, SET_ERROR} from "./actions"

const initialState = {
    user: {
        email: "",
        password: "",
        token: null,
        id: null,
        nickName : ''
    },
    errors: null
}

export const userAuthReducer = (state = initialState, {type, payload})=> {
    switch(type){
        case(SIGNUP_USER): {
            return {
                user:{...state.user, ...payload}
            }
        }
        case(LOGIN_USER): {
            return {
                user:{...state.user, ...payload}
            }
        }
        case(LOGOUT_USER): {
            return {
                user: {...state.user, token: null, id: null}
            }
        }
        case(SET_ERROR): {
            return {
                ...state,
                errors: payload
            }
        }
        default : {
            return state
        }
    }
}