import {SET_CATEGORIES_ALL} from "./actions";

const initialState = {}

export const categoriesReducer = (state = initialState, { type, payload }) => {
    switch (type) {
        case SET_CATEGORIES_ALL: {
            // console.log("categoriesReducer", payload)
            return {
                ...state,
                categories:payload
            }
        }
        default:{
            return state;
        }
    }
}