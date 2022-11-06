import React, { useEffect } from 'react';
import { useNavigate, useParams, Link } from "react-router-dom";
import { useDispatch, useSelector } from "react-redux";
import { getDbArticle, getArticle } from "../../store/articles"
import './ArticleId.scss'
import ArticleStatsIcons from '../../components/Articles/ArticleStatsIcons.jsx'
import getArticleDate from '../../hook/articleDate.js'

function ArticleId() {
  const dispatch = useDispatch(); 
  const { articleId } = useParams();
  let article = useSelector(getArticle);
  

  console.log('article - ',article)
  
  useEffect(()=> {
    console.log('article dispatch - ',articleId)
    dispatch( getDbArticle(articleId) );
  },[])

  const articleDate = !(article.created_at === undefined) ? getArticleDate(article.created_at) : new Date

  
  return (
    <>
      {  article !== undefined ? <>
      <div className="pages-header">
        <h3 >articleId { articleId } </h3> 
      </div>

      <div className="articleId">
        <div className="articleId__header ">
          <h4> {article.user.nickName}</h4>
          <h5> &emsp;{articleDate.dayWriting}&ensp;</h5>
          <h5> в {articleDate.creationTimeArticle}</h5>
        </div>
        <div className='articleId__title'>
          <h4>{article.title}</h4>
        </div>
        <div className='articleId__description'>
          <p>{article.description}</p>
        </div>
        <div className='articleId__tags'>
          <p><span className='articleId__tags-span'>Теги:&ensp;</span>
            {
              article.tags.length > 0 ? article.tags.map((item, key) =>(
                <span key = { key }>{item.title}{key<article.tags.length - 1 ? ',' : '' } </span>
              )) : ''
            }
          </p>
        </div>  
      </div>
      
      
      <div className="articleId">
        <ArticleStatsIcons articleId="true"/>
      </div>
      
      
      <div className="articleId">
        <ArticleStatsIcons articleId="true"/>
      </div></>:''}
    </>
  );
}
  
export default ArticleId;