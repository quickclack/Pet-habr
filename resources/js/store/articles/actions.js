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
        const config = {
            method: 'post',
            url: `/api/articles`,
            headers: { }
        };
        const articles = await axios(config)
            .then(({data})=>{
                console.log("getDbArticlesAll ")
                dispatch(setArticlesAll(data));
            })
    } catch (e) {
        console.log(e.message);
    }
}

export const getDbArticle = (articleId) => async (dispatch) => {
    console.log("getDbArticle")
    try{
        const config = {
            method: 'post',
            url: `/api/article/${articleId}`,
            headers: { }
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


export const getDbArticlesPage = ({param,page}) => async (dispatch) => {
    console.log("getDbArticlesPage - ", page)
    console.log("getDbArticlesPage - ", param)
    try{
        
        const config = {
            method: 'post',
            url: `${param}page=${page}`,
            headers: { }
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
export const getDbArticlesFiltersCategori = (id) => async (dispatch) => {
    console.log("getDbArticlesAll")
    try{
        const articles = await axios({
            method: 'post',
            url: `/api/article?filters[category]=${id}`,
            headers: { }
        })
            .then(({data})=>{
                dispatch(setArticlesAll(data));
            })
    } catch (e) {
        console.log(e.message);
    }
}