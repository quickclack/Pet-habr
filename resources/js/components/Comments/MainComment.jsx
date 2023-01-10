import React, { useState} from 'react';
import { Link } from "react-router-dom";
import './Comments.scss'
import { useDispatch, useSelector } from "react-redux";
import {createDbCommentArticle, setCommentsLoad, getDbCommentsArticle} from "../../store/comments"
import { getIsAuth,  getToken, getErrors, setErrorAction } from "../../store/userAuth";
import  ErrorMessage  from "../VievMessage/ErrorMessage"
function MainComment({articleId}) {
   const [comment, setComment] = useState('')
   
   const authed = useSelector(getIsAuth);
   const dispatch = useDispatch();
   const token = useSelector(getToken)
   const errorList = useSelector(getErrors);
   function commentSubmitHandler(event) {
      setComment(event.target.value);
    }
    console.log("errorList - " , errorList)
   async function sendComment(event) {
      event.preventDefault();
      const logInerror = await dispatch(createDbCommentArticle({comment, articleId, token}));
      console.log("logInerror - " , logInerror)
      if (!logInerror) {
         setTimeout(()=>dispatch(setErrorAction(null) ), 5000)
         return
      } else {
         dispatch(setCommentsLoad)
         dispatch( getDbCommentsArticle({id:articleId,token }) )
         dispatch(setCommentsLoad)
         setComment('')
         dispatch(setErrorAction(null))
      }
      return
      
      
   }
  
   return (
      <>
         {
            authed ? 
            <div className="d-flex align-items-center">
               <div className="mainComment-noautch"></div>
               <div >
                  Только полноправные пользователи могут оставлять комментарии. &nbsp;
                  <Link to="/login" className="text-primary">Войдите</Link>, пожалуйста.
               </div>
            </div> : 
            <div> 
               <div className="h4">Ваш комментарий</div>
               <form onSubmit={sendComment}>
                  <div  className='comments__ansver-form  '>
                     {
                        errorList &&
                        <ErrorMessage message={errorList}/>
                     } 
                     <textarea rows="5"  name="comment"
                        value={comment}
                        onChange={commentSubmitHandler}>
                     </textarea>
                  </div>
                  { comment =='' ? <input className="mainComment-btn" type="button" value="Отправить" title="Введите комментарий"/>:
                  <input className="mainComment-btn active" type="submit" value="Отправить"/>}
               </form>
            </div>
         }
      </>
   );
}
  
export default MainComment;