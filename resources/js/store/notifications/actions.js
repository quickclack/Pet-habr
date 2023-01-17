import axios from 'axios';
import {setArticleCountComments} from '../articles'
import { setErrorAction }  from '../userAuth'
import { setLinksPagination } from '../articles'

export const SET_NOTIFICATIONS = 'SET_NOTIFICATIONS';
export const SET_NOTIFICATION = 'SET_NOTIFICATION'
export const SET_NOTIFICATIONS_VISIBLE_FALSE= 'SET_NOTIFICATIONS_VISIBLE_FALSE'
export const SET_NOTIFICATION_VISIBLE= 'SET_NOTIFICATION_VISIBLE'

export const setNotifications = (payload) => ({
    type: SET_NOTIFICATIONS,
    payload: payload
})
export const setNotification = (payload) => ({
    type: SET_NOTIFICATION,
    payload: payload
})
export const setNotificationsVisibleFalse = (payload) => ({
    type: SET_NOTIFICATIONS_VISIBLE_FALSE,
    payload: payload
})
export const setNotificationVisible = (payload) => ({
    type: SET_NOTIFICATION_VISIBLE,
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

// запрос уведомления по id
export const getDbNotificationsId = ({token, id}) => async (dispatch) => {
    try{
        const config = {
            method: 'post',
            url: `/api/profile/notification/${id}`,
            headers: {
                Accept: 'application/json',
                Authorization: `Bearer ${token}`
            },
        };
        await axios(config)
            .then(({data})=>{
                dispatch(setNotification(data.notification));
                return data.notification
            })
            
           
    } catch (e) {
        console.log(e.message);
    }
}