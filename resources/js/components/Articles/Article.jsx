import React from 'react';
import { Link } from "react-router-dom";





function Article({item}) {
  
  let dayWriting =''
  let dateToday = new Date()
  let dateAtricle = new Date(item.created_at)
  let dateAtricleObject = getDateObject(dateAtricle)
  let dateTodayObject = getDateObject(dateToday)
  let creationTimeArticle = `${dateAtricle.getHours()}:${dateAtricle.getMinutes()}`
   console.log('dateAtricle - ', dateAtricle )
  // console.log( dateAtricleObject, dateTodayObject)
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



  if (dateAtricleObject.year === dateTodayObject.year 
      && dateAtricleObject.month === dateTodayObject.month
      && (dateTodayObject.date - dateAtricleObject.date) < 3 ) {
    // console.log('true - ')
    // console.log(dateTodayObject.date)
    // console.log(dateAtricleObject.date)
    dayWriting = dayWritingArraySting[ dateTodayObject.date - dateAtricleObject.date ]
    // console.log(dayWriting)
  } else {
    // console.log('false - ')
    dayWriting = item.created_at}





  return (
      <div className="article">
        <div className="article__header ">
          <h4>Name {item.id}</h4>
          <h5> &emsp;{dayWriting}&ensp;</h5>
          <h5> в {creationTimeArticle}</h5>
        </div>
        <div className='article__title'>
        <Link to={`/article/${item.id}`} className="nav-btn">
            <h4>{item.title}</h4>
        </Link>
          
        </div>
        <div className='article__description'>
          <p>{item.description}</p>
        </div>
        <div className='article__button'>
          <Link to={`/article/${item.id}`} className="nav-btn">
            Читать далее
          </Link>
          
        </div>
      </div>
           
       
    );
  }
  
export default Article;