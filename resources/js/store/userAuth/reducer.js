import { 
    SIGNUP_USER, 
    LOGIN_USER, 
    LOGOUT_USER, 
    SET_ERROR, 
    AMOUNT_IN_USER, 
    PROFILE_ARTICLES,
    PROFILE_ARTICLES_STATUS,
    PROFILE_USER_PROFILE_NULL,
    PROFILE_COMMENTS_BROWSE
} from "./actions"

const initialState = {
    user: {
        email: "",
        password: "",
        token: null,
        id: null,
        nickName : ''
    },
    errors: null,
    amount:{},
    profileArticles: false,
    profileArticlesStatus: '',
    profileCommets: false,
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
        case(PROFILE_ARTICLES):{
            return {
                ...state,
                profileArticles: payload
            }
        }
        case(PROFILE_ARTICLES_STATUS):{
            return {
                ...state,
                profileArticlesStatus: payload
            }
        }
        case(PROFILE_USER_PROFILE_NULL):{
            return {
                ...state,
                profileArticlesStatus:'',
                profileArticles:false
            }
        }
        case PROFILE_COMMENTS_BROWSE:{
            return {
                ...state,
                profileCommets: payload
            }
        }

        default : {
            return state
        }
    }
}