import React, {useEffect} from 'react';
import { useDispatch, useSelector } from "react-redux";
import ArticlesList from '../../../components/Articles/ArticlesList';
import { getDbArticlesUserProfile, setArticlesPagesUrl, getDbBookmarksArticle} from "../../../store/articles"
import { getToken } from "../../../store/userAuth"



function UserProfileBookmarks() {
  const dispatch = useDispatch();
  const token = useSelector(getToken)
  
  useEffect(()=> {
    console.log("UserProfileBookmarks")
    dispatch( getDbBookmarksArticle({ token }) );
    dispatch( setArticlesPagesUrl('/api/bookmarks?'))
    
  },[]) 
   
  return (
      <>
        <div className="pages-header">
          <h3 >Bookmarks</h3> 
        </div>
        <ArticlesList />
      </>
    );
  }
  
export default UserProfileBookmarks;

