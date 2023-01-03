import React, {useEffect, useState} from 'react';
import { useDispatch, useSelector } from "react-redux";
import { getDbArticlesAll, setArticlesPagesUrl} from "../../store/articles"
import ArticlesList from '../../components/Articles/ArticlesList';
import Loader from "../../components/ui/Loader/Loader"
import { getToken, setUserProfileNull, setProfileArticles, setProfileArticlesStatus } from "../../store/userAuth"

function All() {
  const dispatch = useDispatch(); 
  const token = useSelector(getToken);
  const [loading, setLoading] = useState(true)
  useEffect(()=> {
    setLoading(true)
    console.log("articles dispatch All")
    window.scroll(0, 0);
    const api = {
      url:`/api/articles?sort=created_at`
    }
    if ( getToken !== null ) api.token = token
    dispatch( getDbArticlesAll( api ));
    dispatch( setUserProfileNull());
    dispatch( setArticlesPagesUrl('/api/articles?sort=created_at&'))
    dispatch(setProfileArticles(false))
    dispatch(setProfileArticlesStatus(''))
    setTimeout(()=>setLoading(false), 400)
  },[]) 

  return (
      <>
        <div className="pages-header">
          <h3 >ALL</h3> 
        </div>
        { loading ? <Loader/> :
          <ArticlesList />
        }
      </>
    );
  }
  
export default All;