import axios from 'axios';
export const SIGNUP_USER = "SIGNUP_USER";
export const LOGIN_USER = "LOGIN_USER";
export const LOGOUT_USER = "LOGOUT_USER";
export const SET_ERROR = "SET_ERROR";
export const AMOUNT_IN_USER = "AMOUNT_IN_USER";
export const PROFILE_ARTICLES = "PROFILE_ARTICLES"
export const PROFILE_ARTICLES_STATUS = 'PROFILE_ARTICLES_STATUS'
export const PROFILE_USER_PROFILE_NULL = 'PROFILE_USER_PROFILE_NULL'
export const PROFILE_COMMENTS_BROWSE = 'PROFILE_COMMENTS_BROWSE'

export const setErrorAction = (error) => ({
    type: SET_ERROR,
    payload: error
})
export const logInUser = (user) => ({
    type: LOGIN_USER,
    payload: user
})
export const logOutUser = () => ({
    type: LOGOUT_USER,
});
export const setAmountInUser = (amount) => ({
    type: AMOUNT_IN_USER,
    payload: amount
})
//признак просмотра статей в профиле
export const setProfileArticles = (payload) => ({
    type: PROFILE_ARTICLES,
    payload: payload
})
//статус просмотра статей в профиле
export const setProfileArticlesStatus = (payload) => ({
    type: PROFILE_ARTICLES_STATUS,
    payload: payload
})
//обнуление статусов в профиле
export const setUserProfileNull = (payload) => ({
    type: PROFILE_USER_PROFILE_NULL,
    payload: payload
})
//изменение признака просмотра коментариев в профиле
export const setProfileCommentsBrowse = (payload) => ({
    type: PROFILE_COMMENTS_BROWSE,
    payload: payload
})

//регистрация
export const signUpUserTrunk = (user) => async (dispatch) => {
    console.log("signUpUser")
    console.log(user)
    try{
        // await axios.get('/sanctum/csrf-cookie').then(()=>{
        await   axios.post("/api/auth/registered",{
                email: user.email,
                password: user.password,
                nickName: user.name,
                password_confirmation: user.confirmation
            })
                .then(({data})=>{
                    // console.log('data', data)
                    const userUp = {
                        id: data.id,
                        nickName: data.nickName,
                        token: data.access_token,
                    };
                    dispatch(logInUser(userUp));
                    dispatch(setErrorAction(null))

                    return false
                })
        // })
    } catch (e) {
        // console.log(e);
        // console.log("ошибка - ",e.response.data.message)
        dispatch(setErrorAction(e.response.data.message))
        return true
    }

}
//повторная отправка email
export const resendingUserEmailTrunk = async (dispatch) => {
    console.log("resendingUserEmailTrunk")
    try{
        await axios.post("/api/email/verification-notification")
            .then(({data})=>{
                console.log('data', data)
                const userUp = {
                    email: user.email,
                    token: data.authorisation.token,
                };
                // dispatch(logInUser(userUp));
                dispatch(setErrorAction(null))
                return false
            })
    } catch (e) {
        // console.log(e);
        // console.log("ошибка - ",e.response.data.message)
        dispatch(setErrorAction(e.response.data.message))
        return true
    }
}
//авторизация
export const logInUserTrunk = (user) => async (dispatch) => {
    console.log("logInUserTrunk")
    console.log(user)
    try{
        await    axios.post("api/auth/login",{
            email: user.email,
            password: user.password,
            remember: user.remember,
        })
        .then(({data})=>{
            console.log('data', data)
            const userIn = {
                token: data.access_token,
            };
            if (user.remember) {
                userIn.email =  user.email
                userIn.password = user.password
            }
            dispatch(logInUser(userIn));
            setTimeout(()=> dispatch(UserInfoTrunk(data.access_token)),100)
            dispatch(setErrorAction(null))
            return false
        })
    } catch (e) {
        console.log(e);
        console.log("ошибка - ",e.response.data.message)
        dispatch(setErrorAction(e.response.data.message))
        return true
    }
}
//выход
export const logOutUserAction =(token) => async (dispatch) => {
    console.log("logOutUserAction - " + token)
    try{
        const config = {
            method: 'post',
            url: '/api/auth/logout',
            headers: { 
              Accept: 'application/json', 
              Authorization: `Bearer ${token}`, 
            },
            
        };
        const logout = await axios(config)
        .then(({data})=>{
            console.log('data', data)
            dispatch(logOutUser());
            dispatch(setErrorAction(null))
            return data.message 
        })
        return logout
    } catch (e) {
        console.log("ошибка - ", e)
        // dispatch(setErrorAction(e.response.data.message))
        return true
    }
};
//регистрация через сервисы
export const signUpUserServicesTrunk = (driver) => async (dispatch) => {
    console.log("signUpUserServicesTrunk")
    console.log(driver)
    try{
        await axios.get(`/auth/${driver}/redirect`)
            .then(({data})=>{
                console.log('data', data)
                const userUp = {
                    email: user.email,
                };
                dispatch(logInUser(userUp));
                dispatch(setErrorAction(null))
                return false
            })
    } catch (e) {
        console.log(e);
        console.log("ошибка - ",e.response.data.message)
        dispatch(setErrorAction(e.response.data.message))
        return true
    }
}
//запрос данных пользователя
export const UserInfoTrunk = (token) => async (dispatch) => {
    console.log("UserInfoTrunk")
    console.log(token)
    try{
        const config = {
            method: 'post',
            url: '/api/user/info',
            headers: { 
                Accept: 'application/json', 
                Authorization: `Bearer ${token}`
            }
        };
        await   axios(config)
            .then(({data})=>{
                console.log('data', data)
                dispatch(logInUser(data));
                dispatch(setErrorAction(null))
            })
    } catch (e) {
        console.log("ошибка - ",e)
        // dispatch(setErrorAction(e.response.data.message))
    }
}
//запрос колличества статей комментариев закладок для профиля
export const getDbAmountInfoTrunk = (token) => async (dispatch) => {
    console.log("UserInfoTrunk")
    console.log(token)
    try{
        const config = {
            method: 'post',
            url: '/api/profile/amount',
            headers: { 
                Accept: 'application/json', 
                Authorization: `Bearer ${token}`
            }
        };
        await   axios(config)
            .then(({data})=>{
                console.log('data', data)
                dispatch(setAmountInUser(data));
                dispatch(setErrorAction(null))
            })
    } catch (e) {
        console.log("ошибка - ",e)
        // dispatch(setErrorAction(e.response.data.message))
    }
}
//запрос на обновление данных пользователя
export const getDbUpdatingUserData = ({ token, user}) => async (dispatch) => {
    console.log("getDbUpdatingUserData - ", user)
    try{
        const data = new FormData();
        data.append('firstName', user.firstName);
        data.append('lastName', user.lastName);
        data.append('description', user.description);
        data.append('sex', user.sex);
        if (typeof user.avatar === 'object') data.append('avatar', user.avatar);
        data.append('_method', 'PUT');
        console.log("data - ", data)
        const config = {
            method: 'post',
            url: '/api/profile/update',
            headers: { 
                Accept: 'application/json', 
                Authorization: `Bearer ${token}`,
            },
            data:data
        }
        const res =  await axios(config)
        .then(({data})=>{
            console.log("data resp- ", data.message)
            
            return data.message
        })
        return res
    } catch (e) {
        console.log("ошибка - ", e)
        dispatch(setErrorAction(e.response.data.message))
        return true

    }
}
