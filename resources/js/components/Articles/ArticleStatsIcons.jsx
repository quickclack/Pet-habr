import React,{useState} from 'react';
import { useSelector, useDispatch } from "react-redux";
import { Link } from "react-router-dom";
import './ArticleStatsIcons.scss'
import views from "../../../image/views.png"
import toShare from "../../../image/to_share.png"
import toShareH from "../../../image/to_share_h.png"
import BookmarkIcon from '@mui/icons-material/Bookmark'
import ModeCommentIcon from '@mui/icons-material/ModeComment';
import AutoAwesomeIcon from '@mui/icons-material/AutoAwesome';
import { getToken, getIsAuth } from "../../store/userAuth"
import { getDbArticleLike, getDbArticle, getDbArticleBookmarks} from "../../store/articles"

function ArticleStatsIcons({articleId, item}) {
   const [isBooped, setIsBooped] = useState(false);
   const [userLike, setUserLike] = useState(false);
   const  [bookmark, setBookmark] = useState(false);
   const handleMouseOver = () => {
      setIsBooped(true);
   };
   const dispatch = useDispatch(); 
   const token = useSelector(getToken)
   const isAuth = !useSelector(getIsAuth)
   const handleMouseOut = () => {
      setIsBooped(false);
   };
   console.log("isAuth ", isAuth)
   async function  articleLike() {
      console.log("articleLike")
      await dispatch (getDbArticleLike({token,  articleId: item.id}))
      //  dispatch(getDbArticle({ url: `/api/article/${item.id}` , token}));
      setUserLike(!userLike)
   }

   async function  articleBookmark() {
      console.log("articleBookmark")
      await dispatch (getDbArticleBookmarks({token,  articleId: item.id}))
      //  dispatch(getDbArticle({ url: `/api/article/${item.id}` , token}));
      setBookmark(!bookmark)
   }
   
   return (
      <>
         <div className="article-stats-icons">
            <div className="article-stats-icons__block">
               <div className={`article-stats-icons__elem ${articleId && isAuth? "hover": ""}`} title={item.rating == undefined ? "Рейтинг" :"Всего голосов"}
                  onClick={articleId && isAuth ? ()=>articleLike(): ()=>{}}
               >
                  <AutoAwesomeIcon sx={{ color: `${ item.auth_liked ? '#6e8c96': '#bbcdd6' }` }}/>
               </div>
               <div className="article-stats-icons__elem"
                  
               >
                  { item.likes }
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
               <div 
                  className={`article-stats-icons__elem ${ isAuth ? "hover" : "" }`} 
                  title={bookmark ? "Убрать из закладок" : "Добавить в закладки"}
                  onClick={ isAuth ? ()=>articleBookmark() : ()=>{}}
               >
                  <BookmarkIcon 
                     sx={{ color: `${ bookmark ? '#6e8c96': '#bbcdd6' }`, fontSize: 23}} 
                  />
               </div>
               <div className="article-stats-icons__elem">
                  0
               </div>
            </div>
            <div className="article-stats-icons__block">
               <Link to={`/article/${item.id}/comments`} className="nav-btn">
                  <div className="article-stats-icons__elem hover" title="Комментарии">
                     <ModeCommentIcon 
                        sx={{ color: '#bbcdd6', fontSize: 21}}
                  />
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