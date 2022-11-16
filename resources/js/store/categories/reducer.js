import {SET_CATEGORIES_ALL} from "./actions";



       

const initialState = {
    links:['/design','/web_development','/mobile_development','/marketing']
}

export const categoriesReducer = (state = initialState, { type, payload }) => {
   
    switch (type) {
        case SET_CATEGORIES_ALL: {
            console.log("categoriesReducer", payload)
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