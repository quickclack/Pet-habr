import axios from 'axios';

export const SET_TAGS_ALL = 'SET_TAGS_ALL';


export const setTagsAll = (payload) => ({
    type: SET_TAGS_ALL,
    payload: payload
})



export const getDbTagsAll = () => async (dispatch) => {
    console.log("getDbTagsAll")
    try{
        const categories = await axios({
            method: 'post',
            url: '/api/tags',
        })
            .then(({data})=>{
                console.log("getDbTagsAll respons - ", data)
                dispatch(setTagsAll(data.tags));
            })
    } catch (e) {
        console.log(e.message);
    }
}


