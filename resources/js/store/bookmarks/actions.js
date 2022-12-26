import axios from 'axios';

export const SET_BOOKMARKS_ARTICLE = 'SET_BOOKMARKS_ARTICLE';


export const setBookmarksArticle = (payload) => ({
    type: SET_BOOKMARKS_ARTICLE,
    payload: payload
})



export const getDbBookmarksArticle = ({token}) => async (dispatch) => {
    console.log("getDbBookmarksArticle")
    try{
        const bookmarks = await axios({
            method: 'post',
            url: '/api/bookmarks',
            headers: { 
                Accept: 'application/json', 
                Authorization: `Bearer ${token}`
            }
        })
            .then(({data})=>{
                console.log("getDbBookmarksArticle respons - ", data)
                dispatch(setBookmarksArticle(data));
            })
    } catch (e) {
        console.log(e.message);
    }
}


