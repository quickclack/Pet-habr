import React, {useEffect} from 'react';
import { useDispatch, useSelector } from "react-redux";
import ArticlesList from '../../../components/Articles/ArticlesList';
import { getDbArticlesUserProfile, setArticlesPagesUrl} from "../../../store/articles"
import { getToken, setProfileArticles } from "../../../store/userAuth"
function UserProfileArticles() {
   const dispatch = useDispatch();
   const token = useSelector(getToken)
   useEffect(()=> {
      console.log("articles user profile")
      dispatch( getDbArticlesUserProfile({url:'/api/profile/articles', token}) );
      dispatch( setArticlesPagesUrl(`/api/profile/articles?`) )
      dispatch(setProfileArticles(true))
      return ()=>dispatch(setProfileArticles(false))
   },[]) 

  return (
      <>
        <ArticlesList />
      </>
    );
  }
  
export default UserProfileArticles;

