import React, {useEffect, useState} from 'react';
import { useDispatch, useSelector } from "react-redux";
import ArticlesList from '../../../components/Articles/ArticlesList';
import { getDbArticlesUserProfile, setArticlesPagesUrl} from "../../../store/articles"
import { getToken, setProfileArticles } from "../../../store/userAuth"
import cl from './Articles.module.css';
import Box from '@mui/material/Box';
import IconButton from '@mui/material/IconButton';
import Typography from '@mui/material/Typography';
import Menu from '@mui/material/Menu';
import Avatar from '@mui/material/Avatar';
import Tooltip from '@mui/material/Tooltip';
import MenuItem from '@mui/material/MenuItem';
import { Outlet, Link, useNavigate, useLocation,useParams } from "react-router-dom";

function UserProfileArticles() {
   const dispatch = useDispatch();
   const token = useSelector(getToken)
   const navigate = useNavigate();
   
   const [menuValue, setMenuValue] = useState('');
   useEffect(()=> {
      console.log("articles user profile")
      dispatch( getDbArticlesUserProfile({url:'/api/profile/articles', token}) );
      dispatch( setArticlesPagesUrl(`/api/profile/articles?`) )
      dispatch(setProfileArticles(true))
      return ()=>dispatch(setProfileArticles(false))
   },[]) 
  
  
  const articlesTransfer = (e) => {
    
    console.log(e.target.selectedIndex)
    const link = settings[e.target.selectedIndex].name
    const url = settings[e.target.selectedIndex].url
    setMenuValue(e.target.value)
    dispatch( getDbArticlesUserProfile({url, token}) );
    dispatch( setArticlesPagesUrl(`${url}?`) )
    setTimeout(() => {
        navigate(`/users/Admin22/articles${link}`)
    }, 1)
  }
  
  const settings = [
    {title:'Публикации', 
      name:'',
      url:`/api/profile/articles`},
    {title:'Черновики', 
      name:'/drafts',
      url:`/api/profile/articles?status=1`},
    {title:'На модерации', 
      name:'/moderation',
      url:`/api/profile/articles?status=5`},
    {title:'Отклоненные',
      name:'/rejected', 
      url:`/api/profile/articles?status=15`},
  ];


  return (
    <>
      <div className={cl.article__menu__container}>
        <div className={cl.article__menu}>
          <div className="col-2" title='Открыть список'>
            <select  className={cl.article__menu__select}
              value={menuValue}
              onChange={e => articlesTransfer( e)}
              required
            >
              {settings.map(option =>
                <option 
                  key={option.title} 
                  value={option.title}
                  
                >
                  {option.title}
                </option>
              )}
            </select>
          </div>
        </div>
      </div>
      
      <ArticlesList />
    </>
    );
  }
  
export default UserProfileArticles;

