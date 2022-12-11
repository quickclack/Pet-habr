import axios from 'axios';

export const SET_COMMENTS_ALL = 'SET_COMMENTS_ALL';
export const SET_COMMENTS_ARTICLE = 'SET_COMMENTS_ARTICLE';
export const SET_COMMENTS_USER = 'SET_COMMENTS_USER';
export const SET_COMMENTS_MAIN_VISIBLE = 'SET_COMMENTS_MAIN_VISIBLE';
export const SET_COMMENTS_LOADER = 'SET_COMMENTS_LOADER';

export const setCommentsArticle = (payload) => ({
    type: SET_COMMENTS_ARTICLE,
    payload: payload
})

export const setMainCommentVisible = (payload) => ({
    type: SET_COMMENTS_MAIN_VISIBLE,
    payload: payload
})

export const setCommentsLoad = (payload) => ({
    type: SET_COMMENTS_LOADER,
    payload: payload  
})


export const getDbCommentsArticle = (id) => async (dispatch) => {
    console.log("getDbCommentsArticle -" , id)
    try{
        const config = {
            method: 'post',
            url: `/api/comments/${id}`,
            headers: { }
        };
        const comments = await axios(config)
            .then(({data})=>{
                console.log("getDbCommentsArticle respons - ", data)
                dispatch(setCommentsArticle(data.comments));
            })
    } catch (e) {
        console.log(e.message);
    }
}

export const createDbCommentsArticle = ({comment, articleId, token, commentId}) => async (dispatch) => {
    console.log("createDbCommentsArticle -" + comment + " - " + articleId)
    try{
        const config = {
            method: 'post',
            url: `/api/comment/create`,
            headers: { 
                Accept: 'application/json', 
                Authorization: `Bearer ${token}`
            },
            data:{
                'comment': comment,
                'article_id':parseInt(articleId),
               
            }
        };
        if (commentId) config.data.parent_id = commentId
        const comments = await axios(config)
            .then(({data})=>{
                console.log("createDbCommentsArticle - ", data)
                // dispatch(setCommentsArticle(data.comments));
            })
    } catch (e) {
        console.log(e.message);
    }
}

export const updateDbCommentArticle = ({comment, commentId, token}) => async (dispatch) => {
    console.log("updateDbCommentsArticle -" + comment + " - " + commentId)
    try{
        const config = {
            method: 'put',
            url: `/api/comment/${commentId}/update`,
            headers: { 
                Accept: 'application/json', 
                Authorization: `Bearer ${token}`
            },
            data:{
                'comment': comment,
            }
        };
        const comments = await axios(config)
            .then(({data})=>{
                console.log("updateDbCommentsArticleResp - ", data)
                // dispatch(setCommentsArticle(data.comments));
            })
    } catch (e) {
        console.log(e.message);
    }
}

export const deleteDbCommentArticle = ({ commentId, token}) => async (dispatch) => {
    console.log("deleteDbCommentArticle -" + commentId)
    try{
        const config = {
            method: 'delete',
            url: `/api/comment/${commentId}/delete`,
            headers: { 
                Accept: 'application/json', 
                Authorization: `Bearer ${token}`
            },
            data:{}
        };
        const comments = await axios(config)
            .then(({data})=>{
                console.log("deleteDbCommentArticleResp - ", data)
                // dispatch(setCommentsArticle(data.comments));
            })
    } catch (e) {
        console.log(e.message);
    }
}

