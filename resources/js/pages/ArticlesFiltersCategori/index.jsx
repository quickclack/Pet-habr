import React, {useEffect} from 'react';
import { Routes, Route, useParams } from "react-router-dom";
import { useDispatch } from "react-redux";
import { getDbArticlesAll, getDbArticlesFiltersCategori} from "../../store/articles"
import ArticlesList from '../../components/Articles/ArticlesList';

function ArticlesFiltersCategori() {
  let params = useParams();
  const dispatch = useDispatch(); 

  useEffect(()=> {
    console.log("ArticlesFiltersCategori")
    console.log(params.id)
    dispatch( getDbArticlesFiltersCategori(params.id));
  },[params]) 
  return (
    <>
      <h3 className='pages-header'>Design</h3> 
      <ArticlesList param = {`/api/article?filters[category]=${parseInt(params.id)}&`} />
    </>
  )
}
  
export default ArticlesFiltersCategori;