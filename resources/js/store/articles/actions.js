import axios from 'axios';

export const SET_ARTICLES_ALL = 'SET_ARTICLES_ALL';
export const SET_ARTICLE = 'SET_ARTICLE';

export const setArticlesAll = (payload) => ({
    type: SET_ARTICLES_ALL,
    payload: payload
})

export const setArticle = (payload) => ({
    type: SET_ARTICLE,
    payload: payload
})

export const getDbArticlesAll = () => async (dispatch) => {
    console.log("getDbArticlesAll")
    try{
        const articles = await axios.post("/api/articles")
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
    console.log("getDbArticlesPage",page)
    try{
        const articles = await axios.post(`api/articles?page=${page}`)
            .then(({data})=>{
                dispatch(setArticlesAll(data));
            })
    } catch (e) {
        console.log(e.message);
    }
}