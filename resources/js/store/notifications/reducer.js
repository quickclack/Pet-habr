import {
    SET_NOTIFICATIONS,
    SET_NOTIFICATION,
    SET_NOTIFICATIONS_VISIBLE_FALSE,
    SET_NOTIFICATION_VISIBLE
} from "./actions";

const initialState = {
    notifications: [],
    notification: '',
    visible: []
}

const addVisibleStatus = (notifications) => {
    notifications.forEach((notification)=>{
        notification.visible = false})
        return notifications
}

export const notificationsReducer = (state = initialState, { type, payload }) => {

    switch (type) {
        case SET_NOTIFICATIONS: {
           console.log("NOTIFICATIONS_payload - ", payload)
            return {
                ...state,
                notifications: addVisibleStatus(payload)
                
            }
        }
        case SET_NOTIFICATION: {
            return {
                ...state,
                notification: payload
            }
        }
        case SET_NOTIFICATIONS_VISIBLE_FALSE: {
            return {
                ...state,
                notifications: addVisibleStatus(state.notifications)
                 
            }
        }
        case SET_NOTIFICATION_VISIBLE: {
            const arr = [...state.notifications]
            arr[payload].visible = true
            return {
                ...state,
                notifications: [...arr]
            }
        }
        default:{
            return state;
        }
    }
}
