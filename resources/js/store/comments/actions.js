import axios from 'axios';

export const SET_COMMENTS_ALL = 'SET_COMMENTS_ALL';
export const SET_COMMENTS_ARTICLE = 'SET_COMMENTS_ARTICLE';
export const SET_COMMENTS_USER = 'SET_COMMENTS_USER';
export const SET_COMMENTS_MAIN_VISIBLE = 'SET_COMMENTS_MAIN_VISIBLE';

export const setCommentsArticle = (payload) => ({
    type: SET_COMMENTS_ARTICLE,
    payload: payload
})

export const setMainCommentVisible = (payload) => ({
    type: SET_COMMENTS_MAIN_VISIBLE,
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


