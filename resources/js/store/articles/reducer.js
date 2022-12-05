import {SET_ARTICLES_ALL, SET_ARTICLE, SET_ARTICLES_NULL, SET_ARTICLE_PASSING, SET_ARTICLE_PASSING_NULL} from "./actions";


let dateTransition = new Date()  // текущая дата для изменения
       

const initialState = {}

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
        case SET_ARTICLES_NULL: {
            console.log("articlesNullReducer", payload)
            return {
                ...state,
                ...[]
            }
        }
        case SET_ARTICLE_PASSING: {
            console.log("aArticlePassingReducer", payload)
            return {
                ...state,
                articlePassing:  payload
            }
        }
        case SET_ARTICLE_PASSING_NULL: {
            console.log("aArticlePassingReducer", payload)
            return {
                ...state,
                articlePassing: ''
            }
        }
        default:{
            return state;
        }
    }
}