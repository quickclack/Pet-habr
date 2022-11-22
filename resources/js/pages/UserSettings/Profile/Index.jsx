import React, { useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import { useDispatch, useSelector } from "react-redux";
import './profile.scss';
import { signUpUserTrunk, signUpUserServicesTrunk } from "../../../store/userAuth/actions";
import {ErrorField} from "../../../components/ErrorField";
import {getErrors} from "../../../store/userAuth/selectors";


export const UserSettingsProfile = () => {

    const [firstName, setFirstName] = useState("");
    const [lastName, setLastName] = useState("");
    const [describe, setDescribe] = useState("");
    const [gender, setGender] = useState("");

    const errorList = useSelector(getErrors);

    const dispatch = useDispatch();
    const navigate = useNavigate();

    function firstNameSubmitHandler(event) {
        setFirstName(event.target.value);
    }
    function lastNameSubmitHandler(event) {
        setLastName(event.target.value);
    }
    function describeSubmitHandler(event) {
        setDescribe(event.target.value);
    }
    function genderSubmitHandler(event) {
        setGender(event.target.value);
        console.log(gender)
    }
    function clearForm() {
        setFirstName("");
        setLastName("");
        setDescribe("");
        setGender("");
    }

    async function signUpHandler(event) {
        console.log("signUpHandler")
        event.preventDefault();
        const signUperror = await dispatch(signUpUserTrunk({name, email, password, confirmation}));
        console.log("errorList",errorList)
        if (signUperror) {
            return
        } else {
            navigate("/confirm_email");
            clearForm();
        }
    }

    async function signUpServices(event) {
        console.log("signUpService")
        event.preventDefault();
        const signUperror = await dispatch(signUpUserServicesTrunk('github'));
        console.log("errorList",errorList)
        if (signUperror) {
            return
        } else {
            navigate("/");
            clearForm();
        }
    }


    return (
        <section className="page-wrapper">
            <div className="profile-page">
                <form onSubmit={signUpHandler}>
                    <div className="login-page-text">Настройки</div>
                    <div className="form">
                        <div className="row">
                            <div className="col-7">
                                <div className="text-field">
                                    <label className="text-field__label" >Имя</label>
                                    <input className="text-field__input gy-5" id="firstName" type="text" placeholder="Ваше имя"
                                           value={firstName}
                                           onChange={firstNameSubmitHandler}
                                           required
                                    />
                                </div>
                                <div className="text-field">
                                    <label className="text-field__label" >Фамилия</label>
                                    <input className="text-field__input gy-5" id="lastName" type="text" placeholder="Ваша фамилия"
                                           value={lastName}
                                           onChange={lastNameSubmitHandler}
                                           required
                                    />
                                </div>
                                <div className="text-field">
                                    <label className="text-field__label" >Опишите себя</label>
                                    <input className="text-field__input gy-5" id="describe" type="text" placeholder="Ваша специализация"
                                           value={describe}
                                           onChange={describeSubmitHandler}
                                           required
                                    />
                                    <p className="profile-page_p_describe">Укажите свою специализацию. Например: Фронтенд разработчик</p>
                                </div>
                            </div>
                            <div className="col-1">
                            </div>
                        </div>
                        <div className="row">
                            <div className="col-3">
                                <label className="text-field__label" >Пол</label>

                                <select id="gender" className="text-field__select"
                                        value={gender}
                                        onChange={genderSubmitHandler}
                                        required
                                >
                                    <option value="another">Другой</option>
                                    <option value="female">Мужской</option>
                                    <option value="male">Женский</option>
                                </select>
                            </div>
                        </div>
                        <div className="row justify-content-center">
                            <input className="btn profile-btn" type="submit" value="Сохранить изменения"/>
                        </div>
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
