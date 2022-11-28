import React, {useEffect} from 'react';
import { Routes, Route, useParams } from "react-router-dom";
import { useDispatch, useSelector } from "react-redux";
import { getDbArticlesAll, getDbArticlesFilters, getArticleTags} from "../../store/articles"
import ArticlesList from '../../components/Articles/ArticlesList';

function ArticlesFiltersTags() {
  let params = useParams();
  const dispatch = useDispatch(); 
  const id = parseInt(params.id)
  const tags = useSelector (getArticleTags)
  console.log(tags)
  useEffect(()=> {
    console.log("ArticlesFiltersTags")
    console.log(id)
    dispatch( getDbArticlesFilters(`/api/articles?filters[tags]=${id}`));
  },[id]) 
  return (
    <>
      <h3 className='pages-header'>{ tags }</h3> 
      <ArticlesList param = {`/api/articles?filters[tags]=${parseInt(params.id)}&`} />
    </>
  )
}
  
export default ArticlesFiltersTags;