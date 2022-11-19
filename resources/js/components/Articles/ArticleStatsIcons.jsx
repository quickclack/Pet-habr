import React,{useState} from 'react';

import './ArticleStatsIcons.scss'
import voices from "../../../image/voices.png"
import bookmarks from "../../../image/bookmarks.png"
import comments from "../../../image/comments.png"
import views from "../../../image/views.png"
import toShare from "../../../image/to_share.png"
import toShareH from "../../../image/to_share_h.png"
function ArticleStatsIcons({articleId, item}) {
 
   const [isBooped, setIsBooped] = useState(false);
   const handleMouseOver = () => {
      setIsBooped(true);
   };
   const handleMouseOut = () => {
      setIsBooped(false);
   };
   
   return (
      <>
         <div className="article-stats-icons">
            <div className="article-stats-icons__block">
               <div className="article-stats-icons__elem" title="Всего голосов">
                  <img src={ voices } alt="" />
               </div>
               <div className="article-stats-icons__elem">
                  0
               </div>
            </div>
            <div className="article-stats-icons__block">
               <div className="article-stats-icons__elem" title="Просмотры">
                  <img src={ views } alt="" />
               </div>
               <div className="article-stats-icons__elem ">
                  { item.views || 0 }
               </div>
            </div>
            <div className="article-stats-icons__block ">
               <div className="article-stats-icons__elem hover"title="Добавить в закладки">
                  <img src={ bookmarks } alt="" />
               </div>
               <div className="article-stats-icons__elem">
                  0
               </div>
            </div>
            <div className="article-stats-icons__block">
               <div className="article-stats-icons__elem hover" title="Комментарии">
                  <img src={ comments  } alt="" />
               </div>
               <div className="article-stats-icons__elem">
               { item.count_comments || 0 }
               </div>
            </div>
            { articleId ? <div className="article-stats-icons__block">
               <div className="article-stats-icons__elem hover" title="Поделиться" onMouseOver={handleMouseOver} onMouseOut={handleMouseOut}>
                  <img src={ isBooped ? toShareH : toShare  } alt="" />
               </div>
               
            </div>: ''}
         </div>
      </>
   );
}
  
export default ArticleStatsIcons;