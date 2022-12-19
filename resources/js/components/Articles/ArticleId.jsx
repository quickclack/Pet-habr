import React, { useEffect, useState } from 'react';
import { useNavigate, useParams, Link } from "react-router-dom";
import { useDispatch, useSelector } from "react-redux";
import { getDbArticle, getArticle, setArticlePassing } from "../../store/articles"
import { getMainCommentVisible } from "../../store/comments"
import './ArticleId.scss'
import ArticleStatsIcons from './ArticleStatsIcons.jsx'
import Comments from '../Comments/Comments';
import MainComment from '../Comments/MainComment';
import { getToken, getUserNickName } from "../../store/userAuth"

function ArticleId() {
  const dispatch = useDispatch(); 
  const params = useParams();
  const mainCommentVisible = useSelector(getMainCommentVisible);
  const commentsParam = params.comments === 'comments'
  const articleId = parseInt(params.articleId);
  console.log("params - ", params )
  const token = useSelector(getToken)
  let article = useSelector(getArticle);
  let userName = useSelector(getUserNickName)
  
  console.log('article - ', article )
  console.log('article - ', Object.entries(article).length !== 0 )
  
  useEffect(()=>{ 
    dispatch(getDbArticle({ url: `/api/article/${articleId}` , token}));
    window.scroll(0, 0);
  },[])

  return (
    <>
      { Object.entries(article).length !== 0 ? 
        <>
          <div className="pages-header">
            <h3 >articleId { articleId } </h3> 
          </div>
          <div className="articleId">
            <div className="articleId__header ">
              {params.nameUser ? "ttt":
                <h4> {article.user.nickName}</h4>}
                
              <h5> &emsp;{article.created_at}&ensp;</h5>
            </div>
            <div className='articleId__title'>
              {commentsParam ? <Link to={`/article/${article.id}`} className="nav-btn">
                <h4>{article.title}</h4>
              </Link> :
                
                <h4>{article.title}</h4>}
            </div>
            {
              commentsParam ? '':  
              <div className='articleId__description'>
                <p>{article.description}</p>
              </div>
            }
            <div className='articleId__tags'>
              <p><span className='articleId__tags-span'>Теги:&ensp;</span>
                {
                  article.tags.length > 0 ? article.tags.map((item, key) =>(
                    <Link to={`/articles/tags/${item.id}`} className="nav-btn" key = {item.id}>
                      <span> {item.title}{key<article.tags.length - 1 ? ',' : '' } </span>
                    </Link>
                  )) : ''
                }
              </p>
            </div>  
          </div>
          <div className="articleId articleId-icons">
            <ArticleStatsIcons articleId="true" item={article}/>
          </div> 
          <div className="articleId ">
            <Comments id = { articleId } />
          </div>
          { mainCommentVisible ? 
            <div className="articleId ">
              <MainComment articleId={articleId}/>
            </div>: ''
          }
        </> : ''
      }
    </>
  );
}
  
export default ArticleId;