import axios from 'axios';
import {setArticleCountComments} from '../articles'
import { setErrorAction }  from '../userAuth'
import { setLinksPagination } from '../articles'

export const SET_COMMENTS_ALL = 'SET_COMMENTS_ALL';
export const SET_COMMENTS_ARTICLE = 'SET_COMMENTS_ARTICLE';
export const SET_COMMENTS_USER = 'SET_COMMENTS_USER';
export const SET_COMMENTS_MAIN_VISIBLE = 'SET_COMMENTS_MAIN_VISIBLE';
export const SET_COMMENTS_LOADER = 'SET_COMMENTS_LOADER';
export const SET_COMMENTS_VISIBLE_STATUS = "SET_COMMENTS_VISIBLE_STATUS"
export const SET_OPEN_COMMENTS_ANSWER = "SET_OPEN_COMMENTS_ANSWER"
export const SET_OPEN_COMMENTS_EDIT = "SET_OPEN_COMMENTS_EDIT"
export const SET_CLOSE_COMMENTS_EDIT = "SET_CLOSE_COMMENTS_EDIT"
export const SET_CLOSE_COMMENTS_ANSWER = "SET_CLOSE_COMMENTS_ANSWER"
export const SET_OPEN_COMMENTS_COMMENTS_ANSWER = "SET_OPEN_COMMENTS_COMMENTS_ANSWER"
export const SET_COMMENT_LIKE_AMOUNT = "SET_COMMENT_LIKE_AMOUNT"
export const SET_COMMENT_COMMENT_LIKE_AMOUNT = "SET_COMMENT_COMMENT_LIKE_AMOUNT"
export const SET_COMMENTS_PROFILE = 'SET_COMMENTS_PROFILE'

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
export const setCommentsVisibleStatus = () => ({
    type: SET_COMMENTS_VISIBLE_STATUS,
})
export const setOpenCommentAnswer = (payload) => ({
    type: SET_OPEN_COMMENTS_ANSWER,
    payload: payload
})
export const setOpenCommentEdit = (payload) => ({
    type: SET_OPEN_COMMENTS_EDIT,
    payload: payload
})
export const setOpenCommentCommentsAnswer = (payload) => ({
    type: SET_OPEN_COMMENTS_COMMENTS_ANSWER,
    payload: payload
})
export const setCommentLikeAmount = (payload) => ({
    type: SET_COMMENT_LIKE_AMOUNT,
    payload: payload
})
export const setCommentCommentLikeAmount = (payload) => ({
    type: SET_COMMENT_COMMENT_LIKE_AMOUNT,
    payload: payload
})
export const setCommentsProfile = (payload) => ({
    type: SET_COMMENTS_PROFILE,
    payload: payload
})
//запрос комментариев для статьи
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
                dispatch(setArticleCountComments(data.comments.length))
            })
    } catch (e) {
        console.log(e.message);
    }
}

//добавление комментария к статье или комментарию
export const createDbCommentArticle = ({comment, articleId, token, commentId}) => async (dispatch) => {
    console.log("createDbCommentsArticle -" ,{comment, articleId, token, commentId} )
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
                'article_id': articleId,
                'parent_id': commentId
            }
        };
        if (commentId) config.data.parent_id = commentId
        await axios(config)
            .then(({data})=>{
                console.log("createDbCommentsArticle - ", data)
            })
        return true
    } catch (e) {
        console.log(e.response.data.message);
        dispatch(setErrorAction(e.response.data.message))
        return false
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
        await axios(config)
            .then(({data})=>{
                console.log("updateDbCommentsArticleResp - ", data)
            })
        return true
    } catch (e) {
        console.log(e.response.data.message);
        dispatch(setErrorAction(e.response.data.message))
        return false
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

export const getDbCommentLike = ({ token, commentId, key, parent }) => async (dispatch) => {
    console.log("getDbCommentLike")
    try{
        const config = {
            method: 'post',
            url: `/api/comment/${commentId}/like`,
            headers: {
                Accept: 'application/json',
                Authorization: `Bearer ${token}`
            }
        };
        const articles = await axios(config)
            .then(({data})=>{
                if (parent >= 0) {
                    dispatch(setCommentCommentLikeAmount({value: data.amount, key, parent}))
                } else {
                    dispatch(setCommentLikeAmount({value: data.amount, key}))
                }
            })
    } catch (e) {
        console.log(e.message);
    }
}
//запрос комментариев для вывода в профиле
export const getDbCommentsProfile = ({ token }) => async (dispatch) => {
    console.log("getDbCommentsProfile")
    try{
        const config = {
            method: 'post',
            url: `/api/profile/comments`,
            headers: {
                Accept: 'application/json',
                Authorization: `Bearer ${token}`
            }
        };
        const articles = await axios(config)
            .then(({data})=>{
                console.log('getDbCommentsProfile res- ', data)
                dispatch(setLinksPagination(data.meta))
                dispatch(setCommentsProfile(data.data.comments))
            })
    } catch (e) {
        console.log(e.message);
    }
}
//пагинация комментариев для профиля
export const getDbCommentsProfilePage = ({param, page, token}) => async (dispatch) => {
    try{
        const config = {
            method: 'post',
            url: `/api/profile/comments?page=${page}`,
            headers: {
                Accept: 'application/json',
                Authorization: `Bearer ${token}`
            }
        };
        const articles = await axios(config)
            .then(({data})=>{
                dispatch(setLinksPagination(data.meta))
                dispatch(setCommentsProfile(data.comments))
            })
    } catch (e) {
        console.log(e.message);
    }
}
