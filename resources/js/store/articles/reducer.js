import {SET_ARTICLES_ALL, SET_ARTICLE} from "./actions";


let dateTransition = new Date()  // текущая дата для изменения
       

const initialState = []

export const articlesReducer = (state = initialState, { type, payload }) => {
   
    switch (type) {
        case SET_ARTICLES_ALL: {
            console.log("articlesReducer", payload)
            return {
                ...state,
                articles:payload
            }
        }
        
        case SET_ARTICLE: {
            console.log("articleReducer", payload)
            return {
                ...state,
                article:payload
            }
        }
        default:{
            return state;
        }
    }
}