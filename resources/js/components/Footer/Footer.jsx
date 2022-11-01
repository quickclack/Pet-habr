import React from 'react'
import './Footer.scss'
import { Link } from "react-router-dom";

export const Footer = () => {
    return (
        <>
            <div className="footer">
                <div className="wrapper">
                    <div className="content d-flex justify-content-between">
                        <div className="account">
                            <p>Ваш аккаунт</p>
                            <div className="d-flex flex-column">
                                <Link to="/login" className="nav-btn mb-3">
                                    Войти
                                </Link>
                                <Link to="/signup" className="nav-btn">
                                    Регистрация
                                </Link>
                            </div>
                        </div>
                        <div className="categories">
                            <p>Категории</p>
                            <div className="d-flex flex-column">
                               Вывести все категории
                            </div>
                        </div>
                        <div className="information">
                            <p>Информация</p>
                            <div className="d-flex flex-column">

                            </div>
                        </div>
                        <div className="services">
                            <p>Сервисы</p>
                            <div className="d-flex flex-column">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div className="footer__down">
                <div className="wrapper">
                    <div className="content d-flex justify-content-between">
                        <div className="date mt-4">
                            <p>© 2022 - 2022, by Team</p>
                        </div>
                    </div>
                </div>
            </div>
        </>
    )
}
