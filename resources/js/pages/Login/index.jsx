import React, { useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import './login.scss';
import { useDispatch, useSelector } from "react-redux";

import { logInUserTrunk, getUser } from "../../store/userAuth";

import {getErrors} from "../../store/userAuth/selectors";
import {ErrorField} from "../../components/ErrorField";

export const LogIn = () => {
  const user = useSelector(getUser);
  const [email, setEmail] = useState(user.email);
  const [password, setPassword] = useState(user.password);
  const [remember, setRemember] = useState(true);
  const dispatch = useDispatch();
  const navigate = useNavigate(); 

  const errorList = useSelector(getErrors);
  
  function emailSubmitHandler(event) {
    setEmail(event.target.value);
  }
  function passwordSubmitHandler(event) {
    setPassword(event.target.value);
  }
  function rememberSubmitHandler(event) {
    setRemember(event.target.checked);
  }
  function clearForm() {
    setEmail("");
    setPassword("");
  }

  async function logInHandler(event) {
    console.log("logInHandler")
    event.preventDefault();
    console.log("remember - " + remember)
    const logInerror = await dispatch(logInUserTrunk({email, password, remember}));
    if (logInerror) {
      return
    } else {
      navigate("/articles/all");
      clearForm();
    }
  }

  return (
    <section className="wrapper">
      <div className="login-page">
         <form onSubmit={logInHandler}>
            <div className="login-page-text">Вход на сайт</div>
            <div className="form">
               <div className="text-field">
                  <label className="text-field__label" >Email</label>
                  <input className="text-field__input"
                    type="email" 
                    placeholder="Введите email"
                    value={email}
                    onChange={emailSubmitHandler}
                    required
                  />
               </div>
               <div className="text-field">
                  <label className="text-field__label" >Пароль</label>
                  <input className="text-field__input"
                    type="password" 
                    placeholder="Введите пароль"
                    value={password}
                    onChange={passwordSubmitHandler}
                    required
                  />
               </div>
               <div>
                <label className="text-field__label checkbox" >
                  <input type="checkbox" 
                    checked = {remember}
                    onChange={rememberSubmitHandler}
                  />&emsp; запомнить меня
                </label>
               </div>
               <div className="text-login">
                  <Link to="/signup" style={{ textDecoration: "none" }}>
                  <p> Пройти регистрацию</p>
                  </Link>
               </div>
                  <input className="btn" type="submit" value="Войти"></input>
                  {
                     errorList &&
                      <ErrorField error={errorList}/>
                  }
            </div>
         </form>
      </div>
    </section>
  );
};