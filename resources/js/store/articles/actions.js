import axios from 'axios';

export const SET_ARTICLES_ALL = 'SET_ARTICLES_ALL';
export const SET_ARTICLE = 'SET_ARTICLE';
export const SET_ARTICLES_NULL = 'SET_ARTICLES_NULL';
export const SET_ARTICLE_PASSING = 'SET_ARTICLE_PASSING';
export const SET_ARTICLE_PASSING_NULL = 'SET_ARTICLE_PASSING_NULL'
export const SET_ARTICLES_PAGES_URL = 'SET_ARTICLES_PAGES_URL'
export const SET_ARTICLE_COUNT_COMMENTS = 'SET_ARTICLE_COUNT_COMMENTS'

export const setArticlesAll = (payload) => ({
    type: SET_ARTICLES_ALL,
    payload: payload
})

export const setArticlePassing = (payload) => ({
    type: SET_ARTICLE_PASSING,
    payload: payload
})

export const setArticlePassingNull = () => ({
    type: SET_ARTICLE_PASSING_NULL,
})

export const setArticle = (payload) => ({
    type: SET_ARTICLE,
    payload: payload
})

export const setArticleNull = () => ({
    type: SET_ARTICLES_NULL,
})
export const setArticlesPagesUrl = (payload) => ({
    type: SET_ARTICLES_PAGES_URL,
    payload: payload
})

export const setArticleCountComments = (payload) => ({
    type: SET_ARTICLE_COUNT_COMMENTS,
    payload: payload
})

export const getDbArticlesAll = (url) => async (dispatch) => {
    console.log("getDbArticlesAll")
    try{
        const config = {
            method: 'post',
            url: url,
            headers: { 
                Accept: 'application/json', 
                // Authorization: `Bearer ${token}`
            }
        };
        const articles = await axios(config)
            .then(({data})=>{
                console.log("getDbArticlesAll - ",  data)
                dispatch(setArticlesAll(data));
            })
    } catch (e) {
        console.log(e.message);
    }
}

export const getDbArticle = ({url , token = '' }) => async (dispatch) => {
    console.log("getDbArticle")
    try{
        const config = {
            method: 'post',
            url: url ,
            headers: {
                Accept: 'application/json', 
                Authorization: `Bearer ${token}`
            }
          };
        const articles = await axios(config)
            .then(({data})=>{
                console.log("getDbArticle respons - ", data)
                dispatch(setArticle(data.article));
            })
    } catch (e) {
        console.log(e.message);
    }
}

export const getDbArticlesPage = ({param, page, token}) => async (dispatch) => {
    try{
        const config = {
            method: 'post',
            url: `${param}page=${page}`,
            headers: {
                Accept: 'application/json', 
                Authorization: `Bearer ${token}`
            }
        };
        const articles = await axios(config)
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
        await axios.post("/api/search",{
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
export const getDbArticlesFilters = (url) => async (dispatch) => {
    console.log("getDbArticlesFilters")
    try{
        const articles = await axios({
            method: 'post',
            url: url,
            headers: { }
        })
        .then(({data})=>{
            dispatch(setArticlesAll(data));
        })
    } catch (e) {
        console.log(e.message);
    }
}
export const getDbArticleCreate = ({url,article, token, method}) => async (dispatch) => {
    console.log("getDbArticleCreate - ", article)
    try{
        const data = new FormData();
        data.append('title', article.title);
        data.append('description', article.description);
        data.append('category_id', article.category_id);
        article.tag_id.forEach((element,key) => data.append(`tags[${key}]`, element) );
        // data.append('tags', article.tag_id);
        data.append('image', article.image);
        data.append('_method', method);
        console.log("data - ", data)
        const config = {
            method: 'post',
            url: url,
            headers: { 
                Accept: 'application/json', 
                Authorization: `Bearer ${token}`
            },
            data:data
        }
        const res =  await axios(config)
        .then(({data})=>{
            return data.message
        })
        return res
    } catch (e) {
        console.log("ошибка - ", e)
        return e.response.data.message

    }
}
//запрос статей для вывода в профиле пользователя
export const getDbArticlesUserProfile = ({url, token}) => async (dispatch) => {
    console.log("getDbArticlesUserProfile")
    try{
        const config = {
            method: 'post',
            url: url,
            headers: { 
                Accept: 'application/json', 
                Authorization: `Bearer ${token}`
            }
        };
        const articles = await axios(config)
            .then(({data})=>{
                console.log("getDbArticlesUserProfile - ",  data)
                dispatch(setArticlesAll(data));
            })
    } catch (e) {
        console.log(e.message);
    }
}

export const getDbArticleDelete = ({articleId, token}) => async (dispatch) => {
    console.log("getDbArticleDelete")
    try{
        const config = {
            method: 'delete',
            url: `/api/profile/article/${articleId}/delete`,
            headers: { 
                Accept: 'application/json', 
                Authorization: `Bearer ${token}`
            }
        };
        const articles = await axios(config)
            .then(({data})=>{
                console.log("ggetDbArticleDelete - ",  data)
               
            })
    } catch (e) {
        console.log(e.message);
    }
}
