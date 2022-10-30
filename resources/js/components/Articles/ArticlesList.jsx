import React, {useEffect, useState} from 'react';
import Article from './Article';
function ArticlesList() {
  const [articles, setArticles] = useState([]);


  useEffect(()=> {

   })
   
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