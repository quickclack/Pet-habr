import React, { useEffect, } from 'react';
import { useParams } from "react-router-dom";
import { useDispatch } from "react-redux";
import { getDbArticle, setArticlePassing } from "../../store/articles"
import  ArticleId  from '../../components/Articles/ArticleId'
import './ArticleId.scss'


function ArticleIdPage() {
  const dispatch = useDispatch(); 
  const params = useParams();
  const articleId = parseInt(params.articleId);
 // console.log("params - ", params )
  
  useEffect(()=>{ 
    const id = parseInt(params.articleId);
    const url = `/api/article/${id}`
    dispatch(getDbArticle({url})) 
    dispatch(setArticlePassing(`/article/${articleId}/${params.comments || ''}`))
  },[])

  return (
    <>
      <ArticleId/>
    </>
  )
}
  
export default ArticleId;