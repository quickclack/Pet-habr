import {SET_BOOKMARKS_ARTICLE} from "./actions";

const initialState = {
    
}

export const bookmarksReducer = (state = initialState, { type, payload }) => {
   
    switch (type) {
        case SET_BOOKMARKS_ARTICLE: {
            console.log("SET_BOOKMARKS_ARTICLE Reducer - ", payload)
            return {
                ...state,
                ...payload
            }
        }
        
       
        default:{
            return state;
        }
    }
}