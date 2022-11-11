import axios from 'axios';
import React, {useEffect, useState} from 'react';
import { useSelector, useDispatch } from "react-redux";
import { Link } from "react-router-dom";
import { getDbArticlesAll, getArticlesAll, getPaginationLinks, getDbArticlesPage} from "../../store/articles"
import Article from './Article.jsx';
import './ArticlesList.scss'


function ArticlesList() {
  const dispatch = useDispatch(); 
  const articles =  useSelector(getArticlesAll);
  const [currentPage, setCurrentPage] = useState(1)
 
  const paginationArray = useSelector(getPaginationLinks).slice(1, -1);
  // const [articles, setArticles] = useState([]);

  console.log('pagination', paginationArray)
 
  useEffect(()=> {
    console.log("articles dispatch")
    dispatch( getDbArticlesAll());
  },[])

  console.log('articles - ', articles)

  const paginate = (page) =>{
    
    let curent = currentPage
    switch (page) {
      case '-1' : {
        if (currentPage > 1) {
          setCurrentPage( prev => prev - 1)
          curent--
        }
        break;
      }
      case '+1' : {
        if  (currentPage < paginationArray.length) {
          setCurrentPage( prev => prev + 1)
          curent++
        }
        break;
      }
      default:{
        setCurrentPage(page)
        curent = page 
      }
    }
    dispatch( getDbArticlesPage(curent));
  }
   
  return (
    <>
      {
        articles.length > 0 ? articles.map((item, key) =>(
         <Article key={key} item={item} />
        )) : <h2>Статей нет</h2>
      } 
      <div className="articleId">
        <div className="articles__pagination">
          <div className={`articles__pagination-element `}
                    onClick = {()=>paginate('-1')}
            >
              <span>
                &laquo; Предыдущая
              </span>
          </div>
          
          {
            paginationArray.length > 0 ? paginationArray.map((item, key) =>(
              <div key = { key } className={`articles__pagination-element ${item.active ? 'active':'' }`}
                    onClick = {()=>paginate(parseInt(item.label))}
              >
                  <span>
                    {`${item.label}`}
                  </span>
              </div>
            )) : ''
          }

          <div className={`articles__pagination-element `}
            onClick = {()=>paginate('+1')}
          >
            <span>
              Следующая &raquo;
            </span>
          </div>
        </div>
      </div>
    </>
  );
}
  
export default ArticlesList;