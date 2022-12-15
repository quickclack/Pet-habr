import React, { useEffect} from 'react';
import { useParams} from "react-router-dom";
import  ArticleId  from '../../../components/Articles/ArticleId'
import { useDispatch, useSelector } from "react-redux";
import { getToken, } from "../../../store/userAuth"
import { getDbArticle } from "../../../store/articles"
function UserProfileArticle() {
   const dispatch = useDispatch(); 
   const params = useParams();
   const token = useSelector(getToken);

   useEffect(()=>{ 
      const id = parseInt(params.articleId);
      const url = `/api/profile/article/${id}`
      dispatch(getDbArticle({url, token}))
   },[])

   return (
      <>
         <ArticleId/>
      </>
   )
}

export default UserProfileArticle