import axios from 'axios';
import React, {useEffect, useState} from 'react';
import { Await } from 'react-router-dom';
import Article from './Article.jsx';
import './ArticlesList.scss'

function ArticlesList() {
  const [articles, setArticles] = useState([]);

  console.log(articles)

  useEffect(()=> {
      getArticles()
  },[])

  const getArticles = async () => {
    await axios.post("/api/articles")
      .then(({data})=>{
        console.log('data', data)
        setArticles(data.articles)
        console.log(articles)
        
      }

      )
      
  }
   
  return (
      <>
      {
        articles.length > 0 ? articles.map((item, key) =>(
         
          <Article key={key} item={item}/>
       )) : <h2>Статей нет</h2>
      } 
      </>
           
       
    );
  }
  
export default ArticlesList;