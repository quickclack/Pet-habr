import React, {useEffect, useState} from 'react';
import { useSelector, useDispatch } from "react-redux";
import { getDbCommentsArticle, getCommentsArticle, getCommentsLoad, deleteDbCommentArticle,
   updateDbCommentArticle, setMainCommentVisible, setCommentsLoad, getDbCommentLike,
   setCommentsArticle, setCommentsVisibleStatus, setOpenCommentCommentsAnswer} from "../../store/comments"
import { getUserId, getToken, getIsAuth } from "../../store/userAuth"
import './Comments.scss'
import AutoAwesomeIcon from '@mui/icons-material/AutoAwesome';
import BookmarkIcon from '@mui/icons-material/Bookmark'
import CloseIcon from '@mui/icons-material/Close';
import ComentEdit from "./ComentEdit"

function CommentsComment({comment, articleId, index, parent }) {
   const dispatch = useDispatch(); 
   const authed = useSelector(getIsAuth);
   const userId =  useSelector(getUserId)
   const token = useSelector(getToken)
    
   const [userLike, setUserLike] = useState(false);
   const  [bookmark, setBookmark] = useState(false);
   console.log("CommentsComment authed - ", authed)
   
   const updatingСomments = async () =>{
      dispatch(setCommentsLoad(true))
      // setTimeout(() => setCommentsLoad(prev => !prev), 1000)
      await dispatch( getDbCommentsArticle(articleId) )
      dispatch(setCommentsLoad(false))
   }

   function commentCommentAnswerClose({index, parent}){
      dispatch(setOpenCommentCommentsAnswer({index, parent, value:false, pole:"ansverVisible"}))
      dispatch( setMainCommentVisible(true))
   }
   
   async function openCommentEdit({index, parent}) {
      await dispatch(setCommentsVisibleStatus())
      dispatch(setOpenCommentCommentsAnswer({index, parent, value:true, pole:"editVisible"}))
      dispatch( setMainCommentVisible(false) )
   }

   function commentCommentEditClose({index, parent}) {
      dispatch(setOpenCommentCommentsAnswer({index, parent, value:false, pole:"editVisible"}))
      dispatch( setMainCommentVisible(true))
   }
   
   function sendCommentEdit({index, parent}) {
      commentCommentEditClose({index, parent})
      updatingСomments()
   }

   async function openCommentAnswer({index, parent}) {
      await dispatch(setCommentsVisibleStatus())
      dispatch(setOpenCommentCommentsAnswer({index, parent, value:true, pole:"ansverVisible"}))
      dispatch( setMainCommentVisible(false) )
   }

   async function  deleteComment(commentId) { 
      await dispatch(deleteDbCommentArticle({ commentId, token}));
      updatingСomments()
   }

   async function sendCommentAnswer({index, parent}) {
      commentCommentAnswerClose({index, parent})
      updatingСomments()
   }

   async function commentLike({commentId, key, parent}){
      console.log("acommentLike")
      await dispatch (getDbCommentLike({token,  commentId, key, parent}))
      setUserLike(!userLike)
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
                  <div className={`article-stats-icons__elem ${ !authed ? "hover" :""} `} 
                     title={comment.likes == 0 ? "Комментарий не оценивали" :"Всего голосов"}
                     onClick={ !authed ? 
                        ()=>commentLike({commentId:comment.id, key:index, parent})
                        : ()=>{}}
                     >
                     <AutoAwesomeIcon sx={{ color: `${ comment.auth_liked ? '#6e8c96': '#bbcdd6' }` }}/>
                  </div>
                  <div className="article-stats-icons__elem">
                     { comment.likes || 0}
                  </div>
               </div>
               {   comment.user_id !== userId &&  !authed ?
                  <div className="article-stats-icons__block">
                     <div className="comments__icons__elem-answer"
                        onClick={()=>{
                           openCommentAnswer({ parent_id: comment.parent_id, index, parent})
                        }}
                     >
                        Ответить
                     </div>
                  </div>
                  : ''
               }   
               <div className="article-stats-icons__block ">
                  <div className={`article-stats-icons__elem ${ !authed ? "hover" :""} `} title="Добавить в закладки">
                     <BookmarkIcon 
                        sx={{ color: `${ bookmark ? '#6e8c96': '#bbcdd6' }`, fontSize: 23}} 
                     />
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
                              openCommentEdit({ comment: comment.comment, index, parent})
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
            { comment.ansverVisible ?
               <ComentEdit 
                  title = {`Ответить @${comment.user_name}`} 
                  close = { () => {commentCommentAnswerClose({ index, parent })}}  
                  commenValue = { ''}
                  commentId = { comment.parent_id }
                  sendComment = { () => {sendCommentAnswer({ index, parent })} }
                  name = {'answer'}
                  articleId ={ null }
               />
               : ''
            }
            { comment.editVisible ?
               <ComentEdit 
                  title = { 'Редактировать' } 
                  close = { () => {commentCommentEditClose({ index, parent })}} 
                  commenValue = { comment.comment }
                  commentId = { comment.id }
                  sendComment = {() => sendCommentEdit({ index, parent }) }
                  name = {'edit'}
               />
               : ''
            }
         </div> 
   </>
   );
}
  
export default CommentsComment;