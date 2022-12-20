import {
    SET_ARTICLES_ALL, 
    SET_ARTICLE, SET_ARTICLES_NULL, 
    SET_ARTICLE_PASSING, 
    SET_ARTICLE_PASSING_NULL,
    SET_ARTICLES_PAGES_URL,
    SET_ARTICLE_COUNT_COMMENTS,
    SET_ARTICLE_LIKE_AMOUNT
} from "./actions";


let dateTransition = new Date()  // текущая дата для изменения
       

const initialState = {
    articles: [], //массив статей
    article: {}, // объект статья
    articlePassing: '', // ссылка на статью с корой ушли на авторизацию
    pagesUrl: '' // параметр запроса (url) для пагинации
}

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
            // console.log("articleReducer", payload)
            return {
                ...state,
                article:{...payload}
            }
        }
        case SET_ARTICLES_NULL: {
            // console.log("articlesNullReducer", payload)
            return {
                ...state,
                articles:[]
            }
        }
        case SET_ARTICLE_PASSING: {
            // console.log("aArticlePassingReducer", payload)
            return {
                ...state,
                articlePassing:  payload
            }
        }
        case SET_ARTICLE_PASSING_NULL: {
            // console.log("aArticlePassingReducer", payload)
            return {
                ...state,
                articlePassing: ''
            }
        }
        case SET_ARTICLES_PAGES_URL: {
            // console.log("SET_ARTICLES_PAGES_URL Reducer - ", payload)
            return {
                ...state,
                pagesUrl: payload
            }
        }
        case SET_ARTICLE_COUNT_COMMENTS: {
            return {
                ...state,
                article: {...state.article, count_comments: payload}
            }
        }
        case SET_ARTICLE_LIKE_AMOUNT: {

            return {
                ...state,
                article: {...state.article, likes: payload}
            }
        }
        default:{
            return state;
        }
    }
}