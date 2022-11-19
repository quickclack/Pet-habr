import axios from 'axios';

export const SET_CATEGORIES_ALL = 'SET_CATEGORIES_ALL';


export const setCategoriesAll = (payload) => ({
    type: SET_CATEGORIES_ALL,
    payload: payload
})



export const getDbCategoriesAll = () => async (dispatch) => {
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


