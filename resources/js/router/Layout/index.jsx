import React ,{ useState } from 'react';
import {Link} from "react-router-dom";
import  './Layout.scss'
import { useSelector, useDispatch } from "react-redux";
import { getLinksCategoriesAll, getCategoriesAll } from "../../store/categories"
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
    const dispatch = useDispatch(); 
    const categories = useSelector(getCategoriesAll)
    const categoriesLinks = useSelector(getLinksCategoriesAll)
  return (
    <div className={menuFix ? "cont cont_fixed" : "cont"}>
      {/* <div className={menuFix ? "cont cont_fixed" : "cont"}></div> */}
      <div className="wrapper">
        <div className="menu__container">
          <ul className="menu">
            {/* <img src="src/img/log1.jpg"></img> */}
            <li>
              <Link to="/">Все</Link>
            </li>
            {
              categories.length > 0 ? categories.map((item, key) => (
                <li key = { key }>
                  <Link to={categoriesLinks[key] || '/'}>{item.title}</Link>
                </li>
              )) : ''
            }
          </ul >
          <div className="menu__search">
            <Link to="/search" style={{ textDecoration: "none" }}>
              <div className="menu__search-block" title="Поиск">
              </div>
            </Link>
          </div>
        </div>
      </div>
      
    </div>
  );
};