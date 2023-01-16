import axios from 'axios';
import React, {useEffect, useState} from 'react';
import { useSelector, useDispatch } from "react-redux";
import { getArticlesAll} from "../../store/articles"
import Article from './Article.jsx';
import './ArticlesList.scss'
import ArticlePagination from './ArticlePagination'
import { getToken, UserInfoTrunk } from "../../store/userAuth";
function ArticlesList() {
  const dispatch = useDispatch(); 
  const articles =  useSelector(getArticlesAll);
   // console.log('articles - ', articles)
  const token = useSelector(getToken);
  useEffect(()=>{
    dispatch(UserInfoTrunk (token) )
  },[])
  return (
    <>
      {
        articles.length > 0 ? articles.map((item, key) =>(
         <Article key={item.id} item={item} num={key}/>
        )) : <div className='articles__block-null'><h2>Статей нет</h2></div>
      } 
      <ArticlePagination />
    </>
  );
}
  
export default ArticlesList;