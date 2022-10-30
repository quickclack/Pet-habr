import React, { useState } from "react";
import { Link, useNavigate } from "react-router-dom";
// import { useDispatch, useSelector } from "react-redux";
// import { signUpUserThunk } from "../../store/userAuth/actions";
// import {getErrors} from "../../store/userAuth/selectors";
// import {ErrorField} from "../ErrorField";

export const SignUp = () => {
  const [name, setName] = useState("");
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [confirmation, setConfirmation] = useState("");

  // const errorList = useSelector(getErrors);

  // const dispatch = useDispatch();
  const navigate = useNavigate();

  function nameSubmitHandler(event) {
    setName(event.target.value);
  }

  function emailSubmitHandler(event) {
    setEmail(event.target.value);
  }

  function passwordSubmitHandler(event) {
    setPassword(event.target.value);
  }

  function confirmationSubmitHandler(event) {
    setConfirmation(event.target.value);
  }
  function clearForm() {
    setName("");
    setEmail("");
    setPassword("");
    setConfirmation("");
  }

  async function signUpHandler(event) {
    event.preventDefault();
    // await dispatch(signUpUserThunk(name, email, password, confirmation));
    navigate("/");
    clearForm();
  }

  return (
    <section className="page-wrapper">
      <div className="login-page">
        <form onSubmit={signUpHandler}>
          <div class="login-page-text">Регистрация</div>
          <div className="form">
            <div class="text-field">
              <label class="text-field__label" for="name">Имя</label>
                <input class="text-field__input" id="name" type="text" placeholder="Ваше имя"
                  value={name}
                  onChange={nameSubmitHandler}
                  required
                />
            </div>
            <div class="text-field">
              <label class="text-field__label" for="email">Email</label>
              <input class="text-field__input" id="email" type="email" placeholder="Введите email"
                value={email}
                onChange={emailSubmitHandler}
                required
              />
            </div>
            <div class="text-field">
              <label class="text-field__label" for="password">Пароль</label>
              <input class="text-field__input" id="password" type="password" placeholder="Введите пароль"
                value={password}
                onChange={passwordSubmitHandler}
                required
              />
            </div>
            <div class="text-field">
              <label class="text-field__label" for="_repeat">Повторить пароль</label>
              <input class="text-field__input" id="password_repeat" type="password" placeholder="Повторите пароль"
                value={confirmation}
                onChange={confirmationSubmitHandler}
                required
              />
            </div>
            <div class="remember-me">
              <div class="text-login">
                <Link to="/login"> 
                  <p>Уже есть аккаунт?</p>
                </Link>
              </div>
            </div>
            <input class="btn" type="submit" value="Зерегистрироваться"/> 
            {
              // errorList &&
              //  <ErrorField error={errorList}/>
            }
          </div>
        </form>
      </div>
    </section>
  );
};
