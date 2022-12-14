import React, {useEffect, useState} from 'react';
import CloseIcon from '@mui/icons-material/Close';
import { useSelector, useDispatch } from "react-redux";
import { updateDbCommentArticle, createDbCommentArticle } from "../../store/comments"
import { getUserId, getToken } from "../../store/userAuth"

function ComentEdit({title,  commenValue,  commentId, name, close, sendComment, articleId  }) {
   const dispatch = useDispatch(); 
   const [comment, setComment] = useState(commenValue)
   const token = useSelector(getToken)
   function commentEditSubmitHandler(event) {
      setComment(event.target.value);
   }

   async function sendCommentEdit(e) {
      console.log("sendCommentEdit компонент")
      e.preventDefault();
      console.dir(commentId)
      switch (name) {
         case 'edit':
            await dispatch(updateDbCommentArticle({comment, commentId, token}));
            break;
         case 'answer':
            await dispatch(createDbCommentArticle({comment, articleId, commentId, token}));
            break;
         default:
            break;
      }
      sendComment()
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
            <textarea rows="5"  name="commentComment"
               value={comment}
               onChange={commentEditSubmitHandler}>
            </textarea>
            { comment =='' ? <input className="mainComment-btn" type="button" value="Сохранить" title="Введите комментарий"/>:
            <input className="mainComment-btn active" type="submit" value="Сохранить"/>}
         </form>
      </div>
   </>
   )
}

export default ComentEdit;