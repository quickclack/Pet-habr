import React from 'react'
import './Header.scss'
import { Link } from "react-router-dom";

export const Header = () => {
    return (
        <>
            <div className="header">
                <div className="navbar">
                    <div>
                        <a href="/">
                            <h1>Хабр</h1>
                        </a>
                    </div>
                    <div>
                        <Link to="/login" className="nav-btn">
                            Войти
                        </Link>
                        <Link to="/signup" className="nav-btn ms-3">
                            Регистрация
                        </Link>
                    </div>
                </div>
            </div>
        </>
    )
}
