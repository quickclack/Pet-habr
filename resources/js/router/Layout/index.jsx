import React from 'react';
import {Link} from "react-router-dom";
import  './Layout.scss'

export const Layout = () => {
  return (
    <div className="cont">
      <div className="wrapper">
        
        <ul className="menu">
          {/* <img src="src/img/log1.jpg"></img> */}
          <li>
            <Link to="/">Все</Link>
          </li>
          <li>
            <Link to="/design">Дизайн</Link>
          </li>
          <li>
            <Link to="/web_development">Веб-разработка</Link>
          </li>
          <li>
            <Link to="/mobile_development">Мобильная разработка</Link>
          </li>
          <li>
            <Link to="/marketing">Маркетинг</Link>
          </li>
        </ul >
      </div>
      
    </div>
  );
};