import React from 'react'
import './Header.scss'
import { Link } from "react-router-dom";
import { getIsAuth, logOutUserAction, getToken } from "../../store/userAuth";
import { useDispatch, useSelector } from "react-redux";

export const Header = () => {
    const authed = useSelector(getIsAuth); 
    const token = useSelector(getToken); 
    const dispatch = useDispatch();
    
    return (
        <>
            <div className= "header">
                <div className="navbar">
                    <div>
                        <a href="/">
                            <h1>Хабр</h1>
                        </a>
                    </div>
                    {authed ? (
                    <div>
                        <Link to="/login" className="nav-btn">
                            Войти
                        </Link>
                        <Link to="/signup" className="nav-btn ms-3">
                            Регистрация
                        </Link>
                    </div> ) : (
                    <div>
                        <Link className="nav-btn"  onClick = {()=>dispatch(logOutUserAction(token))}>
                            Выйти
                        </Link>
                        
                    </div>
                    )}
                </div>
            </div>
        </>
    )
}
