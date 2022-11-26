import axios from 'axios';

export const SET_COMMENTS_ALL = 'SET_COMMENTS_ALL';
export const SET_COMMENTS_ARTICLE = 'SET_COMMENTS_ARTICLE';
export const SET_COMMENTS_USER = 'SET_COMMENTS_USER';

export const setCommentsArticle = (payload) => ({
    type: SET_COMMENTS_ARTICLE,
    payload: payload
})



export const getDbCommentsArticle = () => async (dispatch) => {
    console.log("ggetDbCategoriesAll")
    try{
        const articles = await axios({
            method: 'post',
            url: 'api/categories',
        })
            .then(({data})=>{
                console.log(data)
                dispatch(setCategoriesAll(data.categories));
            })
    } catch (e) {
        console.log(e.message);
    }
}


