import {SET_COMMENTS_ALL, SET_COMMENTS_ARTICLE, SET_COMMENTS_USER} from "./actions";

const initialState = []

export const commentsReducer = (state = initialState, { type, payload }) => {
   
    switch (type) {
        case SET_COMMENTS_ARTICLE: {
            console.log("SET_COMMENTS_ARTICLE", payload)
            return {
                ...state,
                comments:payload
            }
        }
        
        default:{
            return state;
        }
    }
}