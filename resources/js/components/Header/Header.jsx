import React from 'react'
import './Header.scss'
import { Link } from "react-router-dom";

export const Header = () => {
   
   return (
      <>
         <div className="header">
            <div className="navbar">
               <h1>Хабр</h1>
               <Link to="/login" className="nav-btn">
                  Войти
               </Link>
            </div>
         </div>
      </>
   )
}