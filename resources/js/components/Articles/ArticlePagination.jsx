import React, { useState } from 'react';
import { useSelector, useDispatch } from "react-redux";
import { getPaginationLinks, getDbArticlesPage, getArticlesPagesUrl } from "../../store/articles"
import { getToken } from "../../store/userAuth"
import './ArticlesList.scss'

function ArticlePagination() {
  const dispatch = useDispatch(); 
  const [currentPage, setCurrentPage] = useState(1)
  const paginationArray = useSelector(getPaginationLinks).slice(1, -1);
  const param = useSelector(getArticlesPagesUrl)
  const token = useSelector(getToken)
  // console.log('pagination - ', paginationArray)
   
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
      dispatch( getDbArticlesPage({param, page: curent, token}) );
  }
   
  return (
    <>
      { paginationArray.length > 1 ?
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
        </div>:''
      }
    </>
  );
}
  
export default ArticlePagination;