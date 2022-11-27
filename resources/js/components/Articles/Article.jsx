import React from 'react';
import { Link } from "react-router-dom";
import ArticleStatsIcons from './ArticleStatsIcons.jsx'
import parse from "html-react-parser";

function Article({item}) {
  
  return (
      <div className="article" >
        <div className="article__header ">
          <h4> {item.user_name}</h4>
          <h5> &emsp;{item.created_at}&ensp;</h5>
        </div>
        <div className='article__title'>
          <Link to={`/article/${item.id}`} className="nav-btn">
              <h4>{item.title}</h4>
          </Link>
        </div>
        <div className='article__description'>
          {parse(item.description)}
        </div>
        <div className='article__button'>
          <Link to={`/article/${item.id}`} className="nav-btn">
            Читать далее
          </Link>
        </div>
        <ArticleStatsIcons item={item}/>
      </div>
    );
  }
  
export default Article;