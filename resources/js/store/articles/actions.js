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

export const getDbArticlesAll = (token) => async (dispatch) => {
    console.log("getDbArticlesAll")
    // try{
    //     const articles = await axios.post("/api/articles",{
    //         headers: {          
    //         'Authorization': "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vZ2ItZmluYWwtcHJvamVjdC9hcGkvYXV0aC9sb2dpbiIsImlhdCI6MTY2ODIwNDM2MywiZXhwIjoxNjY4MjA3OTYzLCJuYmYiOjE2NjgyMDQzNjMsImp0aSI6InE5dWZkRFg0NG8wZzl4ZTQiLCJzdWIiOiIyNyIsInBydiI6IjYwNWIyNjUxYzJmMzcxNmJhYTRmN2I2Nzg2YThhYTJmNTg3YjNkYzgifQ.n_9LU7CPWBNrP_4bsSnMSPhbJ1hkxbe3RtU1xkkNRlM"
    //         }
    //      })
    //         .then(({data})=>{
    //             const result =  data.json()
    //             console.log("getDbArticlesAll -data - ", result) 
    //             // dispatch(setArticlesAll(data.json()));
    //         })

    //         // console.log("getDbArticlesAll -articles - ", articles)   
    // } catch (e) {
    //     console.log(e.message);
    // }

   
    try {
        const response = await fetch("/api/articles", {
            method: 'POST',
            // headers: {
            //     'Authorization': `Bearer ${token}`,
            // },
        })
        const result = await response.json()
        console.log(result)
        dispatch(setArticlesAll(result));
    }catch (e) {
        console.error(e.message)
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