import React from 'react';
import { Link, useParams } from "react-router-dom";
import ArticleStatsIcons from './ArticleStatsIcons.jsx'
import parse from "html-react-parser";

function Article({item}) {
  const params = useParams();
  // console.log( "params - ", params )
  return (
    <div className="article" >
      <div className="article__header ">
        <h4> {item.user_name}</h4>
        <h5> &emsp;{item.created_at}&ensp;</h5>
      </div>
      <div className='article__title'>
        <Link to={`/article/${item.id}`} className="nav-btn">
          <h4>{item.title} {item.id}</h4> 
        </Link>
      </div>
      <div className='article__description'>
        {parse(item.description)}
      </div>
        {
          params.nameUser ? 
          <Link to={`/users/${params.nameUser}/article/${item.id}`} className="nav-btn">
            <div className='article__button'>
              <div >
                далее
              </div>
            </div>
          </Link> :
          <Link to={`/article/${item.id}`} className="nav-btn">
          <div className='article__button'>
            <div >
              Читать далее
            </div>
          </div>
          </Link> 
        }
      <ArticleStatsIcons item={item}/>
    </div>
  );
}
export default Article;