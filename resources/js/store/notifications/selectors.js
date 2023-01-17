export const getNotificationsProfile = (state) => {
    // console.log("notifications -", state.notifications)
  return state.notifications.length == 0 ? [] : state.notifications.notifications
};

export const getNotificationProfile = (state) => {
  // console.log("notifications -", state.notification)
return state.notifications.length == 0 ? [] : state.notifications.notification
};