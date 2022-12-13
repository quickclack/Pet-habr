import axios from 'axios';

export const SET_CATEGORIES_ALL = 'SET_CATEGORIES_ALL';


export const setCategoriesAll = (payload) => ({
    type: SET_CATEGORIES_ALL,
    payload: payload
})



export const getDbCategoriesAll = () => async (dispatch) => {
    console.log("getDbCategoriesAll")
    try{
        const categories = await axios({
            method: 'post',
            url: '/api/categories',
            headers: { 
                Accept: 'application/json', 
            },
        })
            .then(({data})=>{
                // console.log("getDbCategoriesAll respons - ", data)
                dispatch(setCategoriesAll(data.categories));
            })
    } catch (e) {
        console.log(e.message);
    }
}


