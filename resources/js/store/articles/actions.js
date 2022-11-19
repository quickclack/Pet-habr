import axios from 'axios';

export const SET_ARTICLES_ALL = 'SET_ARTICLES_ALL';
export const SET_ARTICLE = 'SET_ARTICLE';
export const SET_ARTICLES_NULL = 'SET_ARTICLES_NULL';

export const setArticlesAll = (payload) => ({
    type: SET_ARTICLES_ALL,
    payload: payload
})

export const setArticle = (payload) => ({
    type: SET_ARTICLE,
    payload: payload
})

export const setArticleNull = () => ({
    type: SET_ARTICLES_NULL,
})

export const getDbArticlesAll = () => async (dispatch) => {
    console.log("getDbArticlesAll")
    try{
        const articles = await axios({
            method: 'post',
            url: '/api/articles',
            // headers: { 
            //   'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vZ2ItZmluYWwtcHJvamVjdC9hcGkvYXV0aC9sb2dpbiIsImlhdCI6MTY2ODI1Njc4NywiZXhwIjoxNjY4MjYwMzg3LCJuYmYiOjE2NjgyNTY3ODcsImp0aSI6IkJLNU5XTzNjMzBTaGJmMUMiLCJzdWIiOiIyMCIsInBydiI6IjYwNWIyNjUxYzJmMzcxNmJhYTRmN2I2Nzg2YThhYTJmNTg3YjNkYzgifQ.EBLD4I4Fh7riHKBNLC6m3V7OYDnC7w8C2TWDqXmvRyk'
            // }
        })
            .then(({data})=>{
                dispatch(setArticlesAll(data));
            })
    } catch (e) {
        console.log(e.message);
    }
}

export const getDbArticle = (articleId) => async (dispatch) => {
    console.log("getDbArticle")
    try{
        const articles = await axios.post(`/api/article/${articleId}`)
            .then(({data})=>{
                dispatch(setArticle(data.article));
            })
    } catch (e) {
        console.log(e.message);
    }
}


export const getDbArticlesPage = (page) => async (dispatch) => {
    console.log("getDbArticlesPage",page,' - ')
    try{
        const articles = await axios.post(`api/articles?page=${page}`)
            .then(({data})=>{
                dispatch(setArticlesAll(data));
            })
    } catch (e) {
        console.log(e.message);
    }
}

export const getDbArticlesSearch = (value) => async (dispatch) => {
    console.log("getDbArticlesSearch ")
    try{
        await axios.post("api/search",{
            search: value,
        })
            .then(({data})=>{
                console.log(data);
                dispatch(setArticlesAll(data));
            })
    } catch (e) {
        console.log(e.message);
    }
}
export const getDbArticlesSearchPage = ({value, page}) => async (dispatch) => {
    console.log("getDbArticlesSearch ")
    try{
        await axios.post(`api/search?page=${page}`,{
            search: value,
        })
            .then(({data})=>{
                console.log(data);
                dispatch(setArticlesAll(data));
            })
    } catch (e) {
        console.log(e.message);
    }
}
