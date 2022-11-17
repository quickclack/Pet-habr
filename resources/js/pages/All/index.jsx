import React, {useEffect} from 'react';
import { useDispatch } from "react-redux";
import { getDbArticlesAll} from "../../store/articles"
import ArticlesList from '../../components/Articles/ArticlesList';

function All() {
  const dispatch = useDispatch(); 
  useEffect(()=> {
    console.log("articles dispatch All")
    dispatch( getDbArticlesAll());
  },[]) 

  return (
      <>
        <div className="pages-header">
          <h3 >ALL</h3> 
        </div>
        <ArticlesList />
      </>
           
       
    );
  }
  
export default All;