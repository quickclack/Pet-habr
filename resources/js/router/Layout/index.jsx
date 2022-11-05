import React ,{ useState} from 'react';
import {Link} from "react-router-dom";
import  './Layout.scss'

export const Layout = () => {
  const [menuFix, setmenuFix] = useState(false);
    window.addEventListener('scroll', function (){
        let scrollY =window.pageYOffset;
        if(scrollY > 68) {
            setmenuFix(true);
           } else {
            setmenuFix(false);
           }
    })

  return (
    <div className={menuFix ? "cont cont_fixed" : "cont"}>
      {/* <div className={menuFix ? "cont cont_fixed" : "cont"}></div> */}
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