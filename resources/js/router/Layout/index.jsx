import React ,{ useState } from 'react';
import {Link} from "react-router-dom";
import  './Layout.scss'
import { useSelector, useDispatch } from "react-redux";
import { getLinksCategoriesAll, getCategoriesAll } from "../../store/categories"
import SearchIcon from '@mui/icons-material/Search';
import { styled, alpha } from '@mui/material/styles';

const SearchIconWrapper = styled('div')(({ theme }) => ({
    padding: theme.spacing(0, 2),
    height: '100%',
    color: '#343ddb',
    pointerEvents: 'none',
    display: 'flex',
    alignItems: 'center',
    justifyContent: 'center',
}));


export const Layout = () => {
    const [menuFix, setmenuFix] = useState(false);
    window.addEventListener('scroll', function (){
        let scrollY = window.pageYOffset;
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
                                    <Link to={`/articles/categories/${item.id}` || '/'}>{item.title}</Link>
                                </li>
                            )) : ''
                        }
                    </ul >
                    <div className="menu__search" title="Поиск">
                        <Link to="/search" style={{ textDecoration: "none" }}>
                            {/* <SearchIcon className="menu__search-block"/> */}
                            {/* <svg className="css-i4bv87-MuiSvgIcon-root menu__search-block" focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="SearchIcon"><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path></svg> */}
                            <svg  className="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium menu__search-block css-i4bv87-MuiSvgIcon-root menu__search-block" focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="SearchIcon"><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path></svg>
                        </Link>
                    </div>
                </div>
            </div>

        </div>
    );
};
