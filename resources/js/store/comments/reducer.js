import {SET_COMMENTS_ALL, SET_COMMENTS_ARTICLE, SET_COMMENTS_USER, SET_COMMENTS_MAIN_VISIBLE, SET_COMMENTS_LOADER} from "./actions";

const initialState = {
    comments: [],
    mainCommentVisible: true,
    commentsLoader: false
}

export const commentsReducer = (state = initialState, { type, payload }) => {
   
    switch (type) {
        case SET_COMMENTS_ARTICLE: {
            // console.log("SET_COMMENTS_ARTICLE", payload)
            return {
                ...state,
                mainCommentVisible: state.mainCommentVisible,
                comments:payload
            }
        }
        case SET_COMMENTS_MAIN_VISIBLE: {
            // console.log("SET_COMMENTS_MAIN_VISIBLE", payload)
            return {
                ...state,
                mainCommentVisible: payload
            }
        }
        case SET_COMMENTS_LOADER: {
            // console.log("SET_COMMENTS_LOADER", payload)
            return {
                ...state,
                commentsLoader: !state.commentsLoader
            }
        }
        
        default:{
            return state;
        }
    }
}