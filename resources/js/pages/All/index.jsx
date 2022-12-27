import React, {useEffect} from 'react';
import { useDispatch, useSelector } from "react-redux";

import { getDbArticlesAll, setArticlesPagesUrl} from "../../store/articles"
import ArticlesList from '../../components/Articles/ArticlesList';

import { getToken } from "../../store/userAuth"

function All() {
  const dispatch = useDispatch(); 
  const token = useSelector(getToken);
  useEffect(()=> {
    console.log("articles dispatch All")
    window.scroll(0, 0);
    const api = {
      url:`/api/articles?sort=created_at`
    }
    if ( getToken !== null ) api.token = token
    dispatch( getDbArticlesAll( api ));
    dispatch( setArticlesPagesUrl('api/articles?sort=created_at&'))
  },[]) 

  return (
      <>
        <div className="pages-header">
          <h3 >ALL</h3> 
        </div>
        <ArticlesList />
      </>
    );
  }
  
export default All;