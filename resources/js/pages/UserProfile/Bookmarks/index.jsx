import React, {useEffect, useState} from 'react';
import { useDispatch, useSelector } from "react-redux";
import ArticlesList from '../../../components/Articles/ArticlesList';
import { getDbArticlesUserProfile, setArticlesPagesUrl, getDbBookmarksArticle} from "../../../store/articles"
import { getToken } from "../../../store/userAuth"
import Loader from "../../../components/ui/Loader/Loader"


function UserProfileBookmarks() {
  const dispatch = useDispatch();
  const token = useSelector(getToken)
  const [loading, setLoading] = useState(true)
  useEffect(()=> {
    console.log("UserProfileBookmarks")
    dispatch( getDbBookmarksArticle({ token }) );
    dispatch( setArticlesPagesUrl('/api/bookmarks?'))
    setLoading(false)
  },[]) 
   
  return (
    <>
      <div className="pages-header">
        <h3 >Bookmarks</h3> 
      </div>
      { loading ? <Loader/> :
        <ArticlesList />
      }
    </>
  );
}
  
export default UserProfileBookmarks;

