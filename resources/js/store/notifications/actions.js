import axios from 'axios';
import {setArticleCountComments} from '../articles'
import { setErrorAction }  from '../userAuth'
import { setLinksPagination } from '../articles'

export const SET_NOTIFICATIONS = 'SET_NOTIFICATIONS';


export const setNotifications = (payload) => ({
    type: SET_NOTIFICATIONS,
    payload: payload
})

//запрос уведомлений
export const getDbNotifications = ({token}) => async (dispatch) => {
    try{
        const config = {
            method: 'post',
            url: `/api/profile/notifications`,
            headers: {
                Accept: 'application/json',
                Authorization: `Bearer ${token}`
            },
        };
        const notifications = await axios(config)
            .then(({data})=>{
                dispatch(setNotifications(data.notifications));
            })
    } catch (e) {
        console.log(e.message);
    }
}


