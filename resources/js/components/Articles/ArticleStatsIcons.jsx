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
import { getToken, getIsAuth, getUserNickName, getUserBan } from "../../store/userAuth"
import { getDbArticleLike, getDbArticle, getDbArticleBookmarks} from "../../store/articles"

function ArticleStatsIcons({articleIdSign, item, num}) {
   const [isBooped, setIsBooped] = useState(false);
   const [userLike, setUserLike] = useState(false);
   const  [bookmark, setBookmark] = useState(false);
   const handleMouseOver = () => {
      setIsBooped(true);
   };
   const banned = useSelector(getUserBan)
   const dispatch = useDispatch(); 
   const token = useSelector(getToken)
   const isAuth = !useSelector(getIsAuth)
   const userAutchNickName = useSelector(getUserNickName) === item.user_name
   const handleMouseOut = () => {
      setIsBooped(false);
   };
    console.log("articleIdSign ", articleIdSign)
   // console.log('item - ', item)
   async function  articleLike() {
      console.log("articleLike")
      await dispatch (getDbArticleLike({token,  articleId: item.id}))
      //  dispatch(getDbArticle({ url: `/api/article/${item.id}` , token}));
      setUserLike(!userLike)
   }

   async function  articleBookmark() {
      console.log("articleBookmark")
      await dispatch (getDbArticleBookmarks({token,  articleId: item.id, articleIdSign, num}))
      //  dispatch(getDbArticle({ url: `/api/article/${item.id}` , token}));
      setBookmark(!bookmark)
   }
   
   return (
      <>
         <div className="article-stats-icons">
            <div className="article-stats-icons__block">
               <div className={`article-stats-icons__elem ${articleIdSign && isAuth? "hover": ""}`} 
                  title={banned ? "Вы не можете ставить лайки - у Вас бан." :
                     item.rating == undefined ? "Рейтинг" :"Всего голосов"}
                  onClick={articleIdSign && isAuth && !banned  ? ()=>articleLike(): ()=>{}}
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
                  className={`article-stats-icons__elem ${ isAuth && !userAutchNickName ? "hover" : "" }`} 
                  title={userAutchNickName ? "Закладки" :
                     item.auth_bookmarks ? "Убрать из закладок" : "Добавить в закладки"}
                  onClick={ isAuth && !userAutchNickName ? ()=>articleBookmark() : ()=>{}}
               >
                  <BookmarkIcon 
                     sx={{ color: `${ item.auth_bookmarks ? '#6e8c96': '#bbcdd6' }`, fontSize: 23}} 
                  />
               </div>
               <div className="article-stats-icons__elem">
               { item.count_bookmarks }
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
            {  <div className="article-stats-icons__block">
               <div className="article-stats-icons__elem hover" title="Поделиться" onMouseOver={handleMouseOver} onMouseOut={handleMouseOut}>
                  <img src={ isBooped ? toShareH : toShare  } alt="" />
               </div>
               
            </div>}
         </div>
      </>
   );
}
  
export default ArticleStatsIcons;