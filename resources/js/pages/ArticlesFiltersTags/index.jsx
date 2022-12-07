import React, {useEffect} from 'react';
import { Routes, Route, useParams } from "react-router-dom";
import { useDispatch, useSelector } from "react-redux";
import { setArticlesPagesUrl, getDbArticlesFilters, getArticleTags} from "../../store/articles"
import ArticlesList from '../../components/Articles/ArticlesList';

function ArticlesFiltersTags() {
  let params = useParams();
  const dispatch = useDispatch(); 
  const id = parseInt(params.id)
  const tags = useSelector (getArticleTags)
  
  useEffect(()=> {
    console.log("ArticlesFiltersTags")
    dispatch( getDbArticlesFilters(`/api/articles?filters[tags]=${id}`));
    dispatch(setArticlesPagesUrl(`/api/articles?filters[tags]=${parseInt(params.id)}&`))
  },[id]) 
  return (
    <>
      <h3 className='pages-header'>{ tags }</h3> 
      <ArticlesList />
    </>
  )
}
  
export default ArticlesFiltersTags;