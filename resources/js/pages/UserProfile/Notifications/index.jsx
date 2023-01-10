import React, { useEffect, useState} from 'react';
import { useParams} from "react-router-dom";
import  ArticleId  from '../../../components/Articles/ArticleId'
import { useDispatch, useSelector } from "react-redux";
import { getToken, } from "../../../store/userAuth"
import { getDbArticle } from "../../../store/articles"
import Loader from "../../../components/ui/Loader/Loader"
function UserProfileNotifications() {
   const dispatch = useDispatch(); 
   const token = useSelector(getToken);
   const [loading, setLoading] = useState(true)
   useEffect(()=>{ 
      setTimeout(()=> setLoading(false), 2000)
   },[])

   return (
      <>
         { loading  ? <Loader/> :
        <div className='articles__block-null'><h2>Уведомлений нет</h2></div>
      }
      </>
   )
}

export default UserProfileNotifications