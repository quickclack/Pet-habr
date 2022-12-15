import React, {useEffect, useState} from 'react';
import { useSelector, useDispatch } from "react-redux";
import { getDbCommentsArticle, getCommentsArticle, getCommentsLoad, deleteDbCommentArticle,
   updateDbCommentArticle, setMainCommentVisible, setCommentsLoad, setCommentsArticle} from "../../store/comments"
import { getUserId, getToken, getIsAuth } from "../../store/userAuth"

import './Comments.scss'
import voices from "../../../image/voices.png"
import bookmarks from "../../../image/bookmarks.png"
import CloseIcon from '@mui/icons-material/Close';
import ComentEdit from "./ComentEdit"

function CommentsComment({comment, articleId}) {
   const dispatch = useDispatch(); 
   const authed = useSelector(getIsAuth);
   const userId =  useSelector(getUserId)
   const token = useSelector(getToken)
   const [commentsCommentsVisible, setCommentsCommentsVisible] = useState(false)
   const [commentsEditVisible, setCommentsEditVisible] = useState(false)
   console.log("CommentsComment authed - ", authed)
   
   const updatingСomments = async () =>{
      dispatch(setCommentsLoad(true))
      // setTimeout(() => setCommentsLoad(prev => !prev), 1000)
      await dispatch( getDbCommentsArticle(articleId) )
      dispatch(setCommentsLoad(false))
   }

   function commentCommentAnswerClose(){
      setCommentsCommentsVisible(false);
      dispatch( setMainCommentVisible(true))
   }
   
   function openCommentEdit() {
      setCommentsEditVisible(true);
      dispatch( setMainCommentVisible(false) )
   }

   function commentCommentEditClose() {
      setCommentsEditVisible(false);
      dispatch( setMainCommentVisible(true))
   }
   
   function sendCommentEdit() {
      commentCommentEditClose()
      updatingСomments()
   }

   function openCommentAnswer() {
      if (commentsCommentsVisible) return
      setCommentsCommentsVisible(true)
      dispatch( setMainCommentVisible(false) )
   }

   async function  deleteComment(commentId) { 
      await dispatch(deleteDbCommentArticle({ commentId, token}));
      updatingСomments()
   }

   async function sendCommentAnswer() {
      commentCommentAnswerClose()
      updatingСomments()
   }
   return (
   <>
      {/* <div className="h3">Ответ @ { comment.id }</div> */}
     
         <div className="row my-3">
            <div className="comments__header">
               <h4> {comment.user_name}</h4>
               <h5> &emsp;{comment.created_at}&ensp;</h5>
            </div>
            
            <span>
               {comment.comment}
            </span>

            <div className='comments__icons__container  '>
               <div className="article-stats-icons__block">
                  <div className="article-stats-icons__elem" title={comment.rating == undefined ? "Комментарий не оценивали" :"Всего голосов"}>
                     <img src={ voices } alt="" />
                  </div>
                  <div className="article-stats-icons__elem">
                     { comment.rating || 0}
                  </div>
               </div>
               {   comment.user_id !== userId &&  !authed ?
                  <div className="article-stats-icons__block">
                     <div className="comments__icons__elem-answer"
                        onClick={()=>{
                           openCommentAnswer({ parent_id: comment.parent_id})// подумать
                        }}
                     >
                        Ответить
                     </div>
                  </div>
                  : ''
               }   
               <div className="article-stats-icons__block ">
                  <div className="article-stats-icons__elem hover"title="Добавить в закладки">
                     <img src={ bookmarks } alt="" />
                  </div>
                  <div className="article-stats-icons__elem">
                     0
                  </div>
               </div>
               { comment.user_id == userId ? 
                  <>
                     <div className="article-stats-icons__block">
                        <div className="comments__icons__elem-answer"
                           onClick={()=>{
                              openCommentEdit({ comment: comment.comment})
                           }}
                           >
                           Редактировать
                        </div>
                     </div>
                     <div className='comments__ansver-close' title="Удалить комментарий"
                        onClick={()=>{
                           deleteComment(comment.id)
                        }}
                     >
                        <CloseIcon/>
                     </div>
                  </>
                  : '' 
               }
            </div>
            { commentsCommentsVisible ?
               <ComentEdit 
                  title = {`Ответить @${comment.user_name}`} 
                  close = {commentCommentAnswerClose}  
                  commenValue = { ''}
                  commentId = { comment.parent_id }
                  sendComment = { sendCommentAnswer }
                  name = {'answer'}
                  articleId ={ null }
               />
               : ''
            }
            { commentsEditVisible ?
               <ComentEdit 
                  title = { 'Редактировать' } 
                  close = { commentCommentEditClose } 
                  commenValue = { comment.comment }
                  commentId = { comment.id }
                  sendComment = { sendCommentEdit }
                  name = {'edit'}
               />
               : ''
            }
         </div> 
   </>
   );
}
  
export default CommentsComment;