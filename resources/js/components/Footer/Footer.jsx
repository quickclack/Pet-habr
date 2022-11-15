import React , {useEffect}from 'react'
import { useSelector, useDispatch } from "react-redux";
import './Footer.scss'
import { Link } from "react-router-dom";

import { getDbCategoriesAll, getCategoriesAll} from "../../store/categories"

export const Footer = () => {
    const dispatch = useDispatch(); 
    const categories = useSelector(getCategoriesAll)
    console.log("categories - ", categories)
    useEffect(()=> {
        console.log("categories dispatch")
        dispatch( getDbCategoriesAll());
      },[])
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
                            <div className="categories__blok d-flex flex-column">
                               {
                                categories.length > 0 ? categories.map((item, key) => (
                                    <div key = { key } className="categories__item">
                                        <Link to="/login" className="nav-btn mb-3">
                                            {item.title}
                                        </Link>
                                        
                                    </div>
                                )) : ''
                               }
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
