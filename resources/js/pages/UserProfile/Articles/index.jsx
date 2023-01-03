import React, {useEffect, useState} from 'react';
import { useDispatch, useSelector } from "react-redux";
import ArticlesList from '../../../components/Articles/ArticlesList';
import { getDbArticlesUserProfile, setArticlesPagesUrl} from "../../../store/articles"
import { getToken, setProfileArticles, setProfileArticlesStatus } from "../../../store/userAuth"
import cl from './Articles.module.css';
import { Outlet, Link, useNavigate, useLocation,useParams } from "react-router-dom";
import { settings } from '../../../utils/ArticlesStatus.js'
import Loader from "../../../components/ui/Loader/Loader"
function UserProfileArticles() {
  const [loading, setLoading] = useState(true)
  const dispatch = useDispatch();
  const token = useSelector(getToken)
  const navigate = useNavigate();
  const [menuValue, setMenuValue] = useState('');
  const params = useParams();
  useEffect( ()=> { 
    console.log("articles user profile")
    dispatch( getDbArticlesUserProfile({url:`/api/profile/articles`, token}) );
    dispatch( setArticlesPagesUrl(`/api/profile/articles&`) )
    dispatch(setProfileArticles(true))
    setLoading(false)
    return ()=>{
      dispatch(setProfileArticles(false))
      dispatch(setProfileArticlesStatus(''))
    }
  },[]) 
  
  
  const articlesTransfer = async (e) => {
    setLoading(true)
    console.log(e.target.selectedIndex)
    const link = settings[e.target.selectedIndex].name
    const url = settings[e.target.selectedIndex].url
    setMenuValue(e.target.value)
    await dispatch( getDbArticlesUserProfile({url, token}) );
     dispatch( setProfileArticlesStatus(link))
     dispatch( setArticlesPagesUrl(`${url}&`))
    setTimeout(() => {
        navigate(`/users/${params.nameUser}/articles${link}`)
    }, 1)
    setTimeout(()=>setLoading(false), 400)
  }
  
  return (
    <>
      <div className={cl.article__menu__container}>
        <div className={cl.article__menu}>
          <div className="col-2" title='Открыть список'>
            <select  className={cl.article__menu__select}
              value={menuValue}
              onChange={e => articlesTransfer(e)}
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
      { loading  ? <Loader/> :
        <ArticlesList />
      }
    </>
    );
  }
  
export default UserProfileArticles;

