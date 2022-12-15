import React, {useEffect, useState} from 'react';
import CloseIcon from '@mui/icons-material/Close';
import { useSelector, useDispatch } from "react-redux";
import { updateDbCommentArticle, createDbCommentArticle } from "../../store/comments"
import { getErrors, getUserId, getToken, setErrorAction } from "../../store/userAuth"

import {ErrorField} from "../ErrorField";
import  ErrorMessage  from "../VievMessage/ErrorMessage"

function ComentEdit({title,  commenValue,  commentId, name, close, sendComment, articleId  }) {
   const dispatch = useDispatch(); 
   const [comment, setComment] = useState(commenValue)
   const token = useSelector(getToken)
   const errorList = useSelector(getErrors);
   console.log("errorList - " , errorList)
   
   function commentEditSubmitHandler(event) {
      setComment(event.target.value);
   }

   async function sendCommentEdit(e) {
      console.log("sendCommentEdit компонент")
      e.preventDefault();
      console.dir(commentId)
      let logInerror = true
      switch (name) {
         case 'edit':
            logInerror =  await dispatch(updateDbCommentArticle({comment, commentId, token}));
            break;
         case 'answer':
            logInerror = await dispatch(createDbCommentArticle({comment, articleId, commentId, token}));
            break;
         default:
            break;
      }
      if (!logInerror) {
         setTimeout(()=>dispatch(setErrorAction(null) ), 5000)
         return
       } else {
      sendComment()}
      return
   }

   return (
   <>
      <div className='comments__ansver__container  '> 
         <div className='comments__ansver'>
            <div className="h4">{ title }</div>
            <div className='comments__ansver-close'
               onClick={()=>{
                  close()
               }}>
               <CloseIcon/>
            </div>
         </div>
         <form onSubmit={sendCommentEdit}>
            <div  className='comments__ansver-form  '>
               {
                  errorList &&
                  <ErrorMessage message={errorList}/>
               } 
           
               <textarea rows="5"  name="commentComment"
                  value={comment}
                  onChange={commentEditSubmitHandler}>
               </textarea>
            </div> 
               { comment =='' ? <input className="mainComment-btn" type="button" value="Сохранить" title="Введите комментарий"/>:
               <input className="mainComment-btn active" type="submit" value="Сохранить"/>}
           
         </form>
      </div>
   </>
   )
}

export default ComentEdit;