import React, { useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import './confirm.scss';
import { useDispatch, useSelector } from "react-redux";

import { logInUserTrunk, getUserEmail, resendingUserEmailTrunk } from "../../store/userAuth";

import {getErrors} from "../../store/userAuth/selectors";
import {ErrorField} from "../../components/ErrorField";

export const ConfirmEmail = () => {
  const email = useSelector(getUserEmail);
  const dispatch = useDispatch();
  const navigate = useNavigate(); 
  const errorList = useSelector(getErrors);
  
  async function resendingUserEmail(event) {
    console.log("resending")
    event.preventDefault();
    const logInerror = await dispatch(resendingUserEmailTrunk());
    if (logInerror) {
      return
    } else {
      navigate("/");
    }
  }

  return (
    <section className="wrapper">
      <div className="login-page">
        
        <div className="login-page-text">Подтвердите почту</div>
        <div className="form">
          <p>На почту {email} отправлено письмо со ссылкой для подтверждения регистрации.
            Если вы не можете найти письмо, проверьте, пожалуйста, папку спам</p>
          <div className="text-field">
                  <label className="text-field__label" >Email</label>
                  {email}
          </div>
              
          <input className="btn" type="submit" value="Отправить письмо повторно" onClick={resendingUserEmail}></input>

          <div className="text-field">
                 <p>Я ошибся, <Link>хочу поменять e-mail</Link></p>
                  
          </div>
                  {
                     errorList &&
                      <ErrorField error={errorList}/>
                  }
        </div>
         
      </div>
    </section>
  );
};