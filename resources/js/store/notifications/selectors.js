export const getNotificationsProfile = (state) => {
    console.log("notifications -", state.notifications)
  return state.notifications.length == 0 ? [] : state.notifications.notifications
};

