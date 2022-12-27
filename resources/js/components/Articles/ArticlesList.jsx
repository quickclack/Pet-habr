import axios from 'axios';
import React, {useEffect, useState} from 'react';
import { useSelector, useDispatch } from "react-redux";
import { getArticlesAll} from "../../store/articles"
import Article from './Article.jsx';
import './ArticlesList.scss'
import ArticlePagination from './ArticlePagination'

function ArticlesList() {
  const dispatch = useDispatch(); 
  const articles =  useSelector(getArticlesAll);
  
  console.log('articles - ', articles)
    
  return (
    <>
      {
        articles.length > 0 ? articles.map((item, key) =>(
         <Article key={key} item={item} num={key}/>
        )) : <h2>Статей нет</h2>
      
      } 
      <ArticlePagination />
    </>
  );
}
  
export default ArticlesList;