import React, { useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import { useDispatch, useSelector } from "react-redux";
import './profile.scss';
import {ErrorField} from "../../../components/ErrorField";
import { getToken, getDbUpdatingUserData, getUser, setErrorAction, getErrors} from "../../../store/userAuth"
import Avatar from '@mui/material/Avatar';
import imgAvatar from "../../../../image/git.png"
import ProfileMessage from '../../../components/VievMessage/ProfileMessage'

export const UserSettingsProfile = () => {
    const dispatch = useDispatch();
    const navigate = useNavigate();
    const [message, setMessage] = useState('');
    const userDB = useSelector(getUser);
    const [user, setUser] = useState({
        firstName: userDB.firstName || '',
        lastName:userDB.lastName || '',
        describe:userDB.describe || '',
        sex:userDB.sex || 'female',
        avatar: userDB.avatar || ''
    });
    const errorList = useSelector(getErrors);
    const token = useSelector(getToken)
      
    function clearForm() {
        setUser({
            firstName:'',
            lastName:'',
            describe:'',
            sex:'female',
            avatar: ''
        })
    }

    async function signUpHandler(event) {
        console.log("signUpHandler")
        event.preventDefault();
        const signUperror = await dispatch(getDbUpdatingUserData({user, token}));
        console.log("errorList",errorList)
        
        if (signUperror === true) {
            setTimeout(()=>dispatch(setErrorAction(null)), 5000)
            return
        } else {
            setMessage(signUperror)
            setTimeout(()=>setMessage(''), 5000)
            // navigate("/confirm_email");
            // clearForm();
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
                                           value={user.firstName}
                                           onChange={e => setUser({...user, firstName:e.target.value })}
                                           required
                                    />
                                </div>
                                <div className="text-field">
                                    <label className="text-field__label" >Фамилия</label>
                                    <input className="text-field__input gy-5" id="lastName" type="text" placeholder="Ваша фамилия"
                                           value={user.lastName}
                                           onChange={e => setUser({...user, lastName:e.target.value })}
                                           required
                                    />
                                </div>
                                <div className="text-field">
                                    <label className="text-field__label" >Опишите себя</label>
                                    <input className="text-field__input gy-5" id="describe" type="text" placeholder="Ваша специализация"
                                           value={user.describe}
                                           onChange={e => setUser({...user, describe:e.target.value })}
                                           required
                                    />
                                    <p className="profile-page_p_describe">Укажите свою специализацию. Например: Фронтенд разработчик</p>
                                </div>
                            </div>
                            <div className="col-1">
                                <div className="mb-3 w-50">
                                    <label className="text-field__label">Аватар</label>
                                    <div className="mb-3">
                                        {user.avatar === '' || user.avatar === undefined  
                                            ? <Avatar alt="Remy Sharp" src={imgAvatar} sx={{ width: 80, height: 80 }}/>
                                            : typeof user.avatar === 'object'
                                                ? <Avatar alt="Remy Sharp" src={URL.createObjectURL(user.avatar)} sx={{ width: 80, height: 80 }}/> 
                                                : <Avatar alt="Remy Sharp" src={`${user.avatar}`} sx={{ width: 80, height: 80 }}/> 
                                                
                                        }
                                    </div>
                                    <input  className="article__edit-page-img" 
                                        type="file"
                                        onChange={e => {
                                            setUser({...user, avatar:e.target.files[0] })}}
                                    />
                                </div>
                            </div>
                            {message === '' ? '' : <ProfileMessage message = {message}/>}
                        </div>
                       
                        <div className="row">
                            <div className="col-3">
                                <label className="text-field__label" >Пол</label>

                                <select id="gender" className="text-field__select"
                                    value={user.sex}
                                    onChange={e => {setUser({...user, sex:e.target.value })
                                    console.log(user.sex)
                                    }}
                                    required
                                >
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
