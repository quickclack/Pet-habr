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
                console.log('data', data)
                // return data.data.articles
                dispatch(setArticlesAll(data.data.articles));
            })
        // console.log('articles', articles);
        // dispatch(setArticlesAll(articles));
    } catch (e) {
        console.log(e.message);
    }
}

export const getDbArticle = (articleId) => async (dispatch) => {
    console.log("getDbArticle")
    try{
        const articles = await axios.post(`/api/article/${articleId}`)
            .then(({data})=>{
                console.log('data', data)
                // return data.data.articles
                dispatch(setArticle(data.article));
            })
        // console.log('articles', articles);
        // dispatch(setArticlesAll(articles));
    } catch (e) {
        console.log(e.message);
    }
}