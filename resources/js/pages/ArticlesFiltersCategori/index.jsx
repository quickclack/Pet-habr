import React, {useEffect, useState} from 'react';
import { Routes, Route, useParams } from "react-router-dom";
import { useDispatch, useSelector } from "react-redux";
import { getDbArticlesFilters, setArticlesPagesUrl, setArticlesAll} from "../../store/articles"
import { getCategoriesAll } from "../../store/categories"
import ArticlesList from '../../components/Articles/ArticlesList';
import Loader from "../../components/ui/Loader/Loader"
function ArticlesFiltersCategori() {
  let params = useParams();
  const dispatch = useDispatch(); 
  const id = parseInt(params.id)
  const categories = useSelector(getCategoriesAll)
  const categoryIdTitle = categories.filter(item => item.id == id)[0].title
  const [loading, setLoading] = useState(true)
  useEffect(()=> {
    setLoading(true)
    // dispatch(setArticlesAll(''))
    window.scroll(0, 0);
    dispatch( getDbArticlesFilters(`/api/articles?filters[category]=${id}&sort=created_at`));
    dispatch(setArticlesPagesUrl(`/api/articles?filters[category]=${parseInt(id)}&sort=created_at&`))
    setTimeout(()=>setLoading(false),400)
    
  },[id]) 

  return (
    <>
      <h3 className='pages-header'>{ categoryIdTitle }</h3> 
      { loading ? <Loader/> :
        <ArticlesList />
      }
    </>
  )
}
  
export default ArticlesFiltersCategori;