import axios from 'axios';
import React, {useEffect, useState} from 'react';
import { useSelector, useDispatch } from "react-redux";
import { getDbArticlesAll, getArticlesAll} from "../../store/articles"
import Article from './Article.jsx';
import './ArticlesList.scss'


function ArticlesList() {
  const dispatch = useDispatch(); 
  const articles = useSelector(getArticlesAll);
  // const [articles, setArticles] = useState([]);

  // console.log(articles)

  useEffect(()=> {
    dispatch( getDbArticlesAll());
  },[])

  // console.log(articles)
   
  return (
    <>
      {
        articles.length > 0 ? articles.map((item, key) =>(
          <>
            <Article key={key} item={item} />
            
          </>
        )) : <h2>Статей нет</h2>
      } 
    </>
  );
}
  
export default ArticlesList;