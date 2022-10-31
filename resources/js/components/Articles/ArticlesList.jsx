import axios from 'axios';
import React, {useEffect, useState} from 'react';
import { Await } from 'react-router-dom';
import Article from './Article';
function ArticlesList() {
  const [articles, setArticles] = useState([]);


  useEffect(()=> {
      getArticles()
  })

  const getArticles = async () => {
    await axios.post("/api/articles")
      .then(({data})=>{
        console.log('data', data)
      }

      )
  }
   
  return (
      <>
      {
        articles.length > 0 ? articles.map((item, key) =>{
         <Article key={key} item={item}/>
        }) : <h2>Статей нет</h2>
      } 
      </>
           
       
    );
  }
  
export default ArticlesList;