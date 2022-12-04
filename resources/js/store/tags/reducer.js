import {SET_TAGS_ALL} from "./actions";

const initialState = {
    tags:[]
}

export const tagsReducer = (state = initialState, { type, payload }) => {
   
    switch (type) {
        case SET_TAGS_ALL: {
            console.log("tagsReducer", payload)
            return {
                ...state,
                tags:payload
            }
        }
        
       
        default:{
            return state;
        }
    }
}