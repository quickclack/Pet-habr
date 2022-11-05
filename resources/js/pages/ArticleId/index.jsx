import React, { useEffect } from 'react';
import { useNavigate, useParams, Link } from "react-router-dom";
import { useDispatch, useSelector } from "react-redux";
import { getDbArticle, getArticle } from "../../store/articles"
import './ArticleId.scss'






function ArticleId() {
  let dayWritingArraySting = {
    0: "сегодня",
    1: "вчера",
    2: "позавчера"
  }
  
  function getDateObject (date) {
    return { year: date.getFullYear(),
            month: date.getMonth(),
            date: date.getDate()
    }
  }

  const dispatch = useDispatch(); 
  const { articleId } = useParams();
  const article = useSelector(getArticle);
  
  console.log('article - ',article)
  useEffect(()=> {
    dispatch( getDbArticle(articleId) );
  },[])

   
  let dayWriting =''
  let dateToday = new Date()
  let dateAtricle = new Date(article.created_at)
  let dateAtricleObject = getDateObject(dateAtricle)
  let dateTodayObject = getDateObject(dateToday)
  let creationTimeArticle = `${dateAtricle.getHours()}:${dateAtricle.getMinutes()}`
  // console.log('dateAtricle - ',(dateToday - dateAtricle)/(24*3600*1000) )
  // console.log( dateAtricleObject, dateTodayObject)

  if (dateAtricleObject.year === dateTodayObject.year 
      && dateAtricleObject.month === dateTodayObject.month
      && (dateTodayObject.date - dateAtricleObject.date) < 3) {
     dayWriting = dayWritingArraySting[ dateTodayObject.date - dateAtricleObject.date ]
  } else dayWriting = article.created_at



  return (
    <>
      <div className="pages-header">
        <h3 >articleId { articleId } </h3> 
      </div>

      <div className="articleId">
        <div className="articleId__header ">
          <h4> {article.user.nickName}</h4>
          <h5> &emsp;{dayWriting}&ensp;</h5>
          <h5> в {creationTimeArticle}</h5>
        </div>
        <div className='articleId__title'>
          <h4>{article.title}</h4>
        </div>
        <div className='articleId__description'>
          <p>{article.description}</p>
        </div>
        
      </div>
    </>
  );
}
  
export default ArticleId;