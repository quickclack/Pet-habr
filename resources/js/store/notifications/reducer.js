import {
    SET_NOTIFICATIONS,
} from "./actions";

const initialState = {
    notifications: []
}

export const notificationsReducer = (state = initialState, { type, payload }) => {

    switch (type) {
        case SET_NOTIFICATIONS: {
           console.log("NOTIFICATIONS_payload - ", payload)
            return {
                ...state,
                notifications: payload
            }
        }
        default:{
            return state;
        }
    }
}
