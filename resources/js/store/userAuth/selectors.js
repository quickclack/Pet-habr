export const getIsAuth = (state) => {
   //  console.log(state.auth)
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
   //  console.log(state)
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
   //  console.log(state.auth)
   return state.auth.user.nickName
};
export const getUserRoles = (state) => {
   //  console.log(state.auth)
   return (state.auth.user.roles === "Administrator" || state.auth.user.roles === "Moderator")
};
export const getUserAmount = (state) => {
     console.log(state.auth)
   return state.auth.amount 
};
