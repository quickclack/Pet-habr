import {
    SET_COMMENTS_VISIBLE_STATUS,
    SET_COMMENTS_ALL, 
    SET_COMMENTS_ARTICLE, 
    SET_COMMENTS_USER, 
    SET_COMMENTS_MAIN_VISIBLE, 
    SET_COMMENTS_LOADER,
    SET_OPEN_COMMENTS_ANSWER,
    SET_OPEN_COMMENTS_EDIT,
    SET_OPEN_COMMENTS_COMMENTS_ANSWER,
    SET_COMMENT_LIKE_AMOUNT,
    SET_COMMENT_COMMENT_LIKE_AMOUNT,
} from "./actions";

const initialState = {
    comments: [],
    mainCommentVisible: true,
    commentsLoader: false
}

const addVisibleStatus = (comments) => {
    const arr = [...comments]
    console.log("SET_COMMENTS_ARTICLE - arr", arr)
    arr.forEach((comment)=>{
    console.log("SET_COMMENTS_ARTICLE - comment", comment)
    comment.ansverVisible = false
    comment.editVisible = false
    if ("replies_comment" in comment) { 
        comment.replies_comment.forEach((item)=>{
            item.ansverVisible = false
            item.editVisible = false
        })}
    })
    return arr
}

export const commentsReducer = (state = initialState, { type, payload }) => {
   
    switch (type) {
        case SET_COMMENTS_ARTICLE: {
            return {
                ...state,
                mainCommentVisible: state.mainCommentVisible,
                comments: addVisibleStatus(payload)
            }
        }
        case SET_COMMENTS_MAIN_VISIBLE: {
            return {
                ...state,
                mainCommentVisible: payload
            }
        }
        case SET_COMMENTS_LOADER: {
            return {
                ...state,
                commentsLoader: payload 
            }
        }
        case SET_COMMENTS_VISIBLE_STATUS: {
            return {
                ...state,
                comments:  addVisibleStatus(state.comments)
            }
        }
        case SET_OPEN_COMMENTS_ANSWER: {
            const arr = [...state.comments]
            arr[payload.key].ansverVisible = payload.value
            return {
                ...state,
                comments: [...arr]
            }
        }
                
        case SET_OPEN_COMMENTS_EDIT: {
            const arr = [...state.comments]
            arr[payload.key].editVisible = payload.value
            return {
                ...state,
                comments: [...arr]
            }
        }
        
        case SET_OPEN_COMMENTS_COMMENTS_ANSWER: {
            const arr = [...state.comments]
            arr[payload.parent].replies_comment[payload.index][payload.pole] = payload.value
            return {
                ...state,
                comments: [...arr]
            }
        }
        
        case SET_COMMENT_LIKE_AMOUNT: {
            const arr = [...state.comments]
            arr[payload.key].likes = payload.value
            arr[payload.key].auth_liked = !arr[payload.key].auth_liked
            return {
                ...state,
                comments: [...arr]
            }
        }

        case SET_COMMENT_COMMENT_LIKE_AMOUNT: {
            const arr = [...state.comments]
            arr[payload.parent].replies_comment[payload.key].likes = payload.value
            arr[payload.parent].replies_comment[payload.key].auth_liked = !arr[payload.parent].replies_comment[payload.key].auth_liked 
            return {
                ...state,
                comments: [...arr]
            }
        }

        default:{
            return state;
        }
    }
}