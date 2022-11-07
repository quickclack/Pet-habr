import axios from 'axios';

export const SIGNUP_USER = "SIGNUP_USER";
export const LOGIN_USER = "LOGIN_USER";
export const LOGOUT_USER = "LOGOUT_USER";
export const SET_ERROR = "SET_ERROR";


export const signUpUser = () => async (dispatch) => {
  console.log("signUpUser")
  try{
      const articles = await axios.post("/api/auth/registered")
          .then(({data})=>{
              console.log('data', data)
              // return data.data.articles
              dispatch(setArticlesAll(data));
          })
      // console.log('articles', articles);
      // dispatch(setArticlesAll(articles));
  } catch (e) {
      console.log(e.message);
  }
}

