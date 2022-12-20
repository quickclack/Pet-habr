import React,{useState} from 'react';
import { useSelector, useDispatch } from "react-redux";
import { Link } from "react-router-dom";
import './ArticleStatsIcons.scss'
import voices from "../../../image/voices.png"
import bookmarks from "../../../image/bookmarks.png"
import comments from "../../../image/comments.png"
import views from "../../../image/views.png"
import toShare from "../../../image/to_share.png"
import toShareH from "../../../image/to_share_h.png"
import { getToken } from "../../store/userAuth"
import { getDbArticleLike, getDbArticle} from "../../store/articles"

function ArticleStatsIcons({articleId, item}) {
   const [isBooped, setIsBooped] = useState(false);
   const [userLike, setUserLike] = useState(false);
   const handleMouseOver = () => {
      setIsBooped(true);
   };
   const dispatch = useDispatch(); 
   const token = useSelector(getToken)
   const handleMouseOut = () => {
      setIsBooped(false);
   };

   async function  articleLike() {
      console.log("articleLike")
      await dispatch (getDbArticleLike({token,  articleId: item.id}))
      //  dispatch(getDbArticle({ url: `/api/article/${item.id}` , token}));
      //setUserLike(!userLike)
   }
   
   return (
      <>
         <div className="article-stats-icons">
            <div className="article-stats-icons__block">
               <div className="article-stats-icons__elem" title={item.rating == undefined ? "Рейтинг" :"Всего голосов"}
                  onClick={articleId ? ()=>articleLike(): ()=>{}}
               >
                  <img src={ voices } alt="" />
               </div>
               <div className="article-stats-icons__elem"
                  
               >
                  { item.likes ? item.likes + userLike: 0}
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
               <Link to={`/article/${item.id}/comments`} className="nav-btn">
                  <div className="article-stats-icons__elem hover" title="Комментарии">
                     <img src={ comments  } alt="" />
                  </div>
               </Link>
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