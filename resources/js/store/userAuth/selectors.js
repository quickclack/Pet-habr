export const getIsAuth = (state) => {
   // console.log(state.auth)
   return state.auth.user.token === null;
};

export const getUser = (state) => {
   // console.log(state.auth)
   return state.auth.user
};

export const getUserEmail = (state) => {
   // console.log(state.auth.user)
   return state.auth.user.email ;
}

export const getToken = (state) => {
   // console.log(state)
   return  state.auth.user !== null ? state.auth.user.token: ''};

export const getErrors = (state) => {
   // console.log(state.auth)
   return state.auth.errors
};

export const getUserId = (state) => {
   // console.log(state.auth)
   return state.auth.user.id
};

export const getUserNickName = (state) => {
   // console.log(state.auth)
   return state.auth.user.nickName
};
export const getUserRoles = (state) => {
   // console.log(state.auth)
   return (state.auth.user.roles === "Administrator" || state.auth.user.roles === "Moderator")
};
export const getUserAmount = (state) => {
   //   console.log(state.auth)
   return state.auth.amount 
};

export const getProfileArticles = (state) => {
   // console.log(state.auth)
   return state.auth.profileArticles 
};

export const getUserAvatar = (state) => {
   // console.log(state.auth)
   return state.auth.user.avatar
};
export const getProfileArticlesStatus = (state) => {
   // console.log(state.auth)
   return state.auth.profileArticlesStatus 
};
export const getProfileCommentsBrowse = (state) => {
   // console.log(state.auth)
   return state.auth.profileCommets 
};
export const getUserBan = (state) => {
   // console.log(state.auth)
   return state.auth.user.banned 
};