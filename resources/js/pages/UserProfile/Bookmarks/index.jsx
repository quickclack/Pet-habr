import React, {useEffect} from 'react';
import { useDispatch, useSelector } from "react-redux";
import ArticlesList from '../../../components/Articles/ArticlesList';
import { getDbArticlesUserProfile, setArticlesPagesUrl} from "../../../store/articles"
import { getBookmarksArticle, getDbBookmarksArticle } from "../../../store/bookmarks"
import { getToken} from "../../../store/userAuth"

function UserProfileBookmarks() {
  const dispatch = useDispatch();
  const token = useSelector(getToken)
  const bookmarksArticle = useSelector(getBookmarksArticle)
  useEffect(()=> {
    console.log("UserProfileBookmarks")
    dispatch( getDbBookmarksArticle({ token }) );
    
  },[]) 
   console.log("bookmarksArticle - ", bookmarksArticle)
  return (
      <>
        <div className="pages-header">
          <h3 >Bookmarks</h3> 
        </div>
        
      </>
    );
  }
  
export default UserProfileBookmarks;

