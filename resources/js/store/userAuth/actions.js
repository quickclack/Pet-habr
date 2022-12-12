import axios from 'axios';
export const SIGNUP_USER = "SIGNUP_USER";
export const LOGIN_USER = "LOGIN_USER";
export const LOGOUT_USER = "LOGOUT_USER";
export const SET_ERROR = "SET_ERROR";
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
        // axios.get('/sanctum/csrf-cookie').then(()=>{
         await    axios.post("api/auth/login",{
                email: user.email,
                password: user.password,
                remember: user.remember,
            })
                .then(({data})=>{
                    console.log('data', data)

                    const userIn = {
                        id: data.id,
                        nickName: data.nickName,
                        token: data.access_token,
                    };
                    if (user.remember) {
                        userIn.email =  user.email
                        userIn.password = user.password
                    }
                    dispatch(logInUser(userIn));
                    dispatch(setErrorAction(null))
                    return false
                })
        // })
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
