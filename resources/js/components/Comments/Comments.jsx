import React, {useEffect, useState} from 'react';
import { useSelector, useDispatch } from "react-redux";
import { Link } from "react-router-dom";
import { getDbCommentsArticle, getCommentsArticle, getCommentsLoad, deleteDbCommentArticle,
   updateDbCommentArticle, setMainCommentVisible, setCommentsLoad, 
   setCommentsArticle, setCommentsVisibleStatus,
   setOpenCommentAnswer, setOpenCommentEdit, getDbCommentLike } from "../../store/comments"
import { getUserId, getToken, getIsAuth } from "../../store/userAuth"
import CachedIcon from '@mui/icons-material/Cached';
import './Comments.scss'

import AutoAwesomeIcon from '@mui/icons-material/AutoAwesome';
import BookmarkIcon from '@mui/icons-material/Bookmark'
import CloseIcon from '@mui/icons-material/Close';
import ComentEdit from "./ComentEdit"
import CommentsComment from "./CommentsComment"
function Comments({id}) {
   const commentsLoad = useSelector(getCommentsLoad)
   const dispatch = useDispatch(); 
   const authed = useSelector(getIsAuth);
   const comments =  useSelector(getCommentsArticle);
   const userId =  useSelector(getUserId)
   const token = useSelector(getToken)
   console.log('comments - ', comments)
   const [userLike, setUserLike] = useState(false); 
   const  [bookmark, setBookmark] = useState(false);
   console.log('comments - ', comments)
   
   useEffect(()=>{
      dispatch(setCommentsArticle(''))
      updatingСomments()
   },[])

   const updatingСomments = async () =>{
      dispatch(setCommentsLoad(true))
      // setTimeout(() => setCommentsLoad(prev => !prev), 1000)
      await dispatch(getDbCommentsArticle(id))
      dispatch(setCommentsLoad(false))
   }

   async function openCommentAnswer({key}){
      await dispatch(setCommentsVisibleStatus())
      dispatch(setOpenCommentAnswer({key, value:true}))
      dispatch(setMainCommentVisible(false))
   }

   function commentCommentAnswerClose({key}){
      dispatch(setOpenCommentAnswer({key, value:false}))
      dispatch( setMainCommentVisible(true))
   }
   
   async function openCommentEdit({key}) {
      await dispatch(setCommentsVisibleStatus())
      dispatch(setOpenCommentEdit({key, value:true}))
      dispatch( setMainCommentVisible(false) )
   }
   
   function commentCommentEditClose({key}) {
      dispatch(setOpenCommentEdit({key, value:false}))
      dispatch( setMainCommentVisible(true))
   }
   
   function sendCommentEdit({key}) {
      commentCommentEditClose({key})
      updatingСomments()
   }
   
   async function  deleteComment(commentId) { 
      await dispatch(deleteDbCommentArticle({ commentId, token}));
      updatingСomments()
   }
   
   async function sendCommentAnswer({key}) {
      commentCommentAnswerClose({key})
      updatingСomments()
   }
   async function  commentLike({commentId, key}) {
      console.log("acommentLike")
      await dispatch (getDbCommentLike({token,  commentId, key}))
      setUserLike(!userLike)
   }
   
   return (
   <>
      <div className="h3">Комментарии { comments.length }</div>
      {
         comments.length == 0 ? 
         <div className="d-flex justify-content-center my-4">
            <small className="text-muted">Здесь пока нет ни одного комментария, вы можете стать первым!</small>
         </div>
         :  comments.map((item, key) =>(
         <div key = { item.id } className="row my-3">
            <div className="comments__header">
               <h4> {item.user_name}</h4>
               <h5> &emsp;{item.created_at}&ensp;</h5>
            </div>
            
            <span>
               {`${item.comment}`}
            </span>

            <div className='comments__icons__container  '>
               <div className="article-stats-icons__block">
                  <div className={`article-stats-icons__elem ${ getIsAuth ? "hover" :""} `} 
                     title={item.likes == 0 ? "Комментарий не оценивали" :"Всего голосов"}
                     onClick={ getIsAuth ? 
                        ()=>commentLike({commentId:item.id, key})
                        : ()=>{}}
                  >
                     <AutoAwesomeIcon sx={{ color: `${ userLike ? '#6e8c96': '#bbcdd6' }` }}/>
                  </div>
                  <div className="article-stats-icons__elem">
                     { item.likes || 0}
                  </div>
               </div>
               {   item.user_id !== userId &&  !authed ?
                  <div className="article-stats-icons__block">
                     <div className="comments__icons__elem-answer"
                        onClick={()=>{
                           openCommentAnswer({key})
                        }}
                     >
                        Ответить
                     </div>
                  </div>
                  : ''
               }   
               <div className="article-stats-icons__block ">
                  <div className={`article-stats-icons__elem ${ getIsAuth ? "hover" :""} `} 
                     title="Добавить в закладки"
                     onClick={ getIsAuth ? ()=>commentsBookmark(): ()=>{}}
                  >
                     <BookmarkIcon 
                        sx={{ color: `${ bookmark ? '#6e8c96': '#bbcdd6' }`, fontSize: 23}} 
                     />
                  </div>
                  <div className="article-stats-icons__elem">
                     0
                  </div>
               </div>
               { item.user_id == userId ? 
                  <>
                     <div className="article-stats-icons__block">
                        <div className="comments__icons__elem-answer"
                           onClick={()=>{
                              openCommentEdit({key})
                           }}
                           >
                           Редактировать
                        </div>
                     </div>
                     <div className='comments__ansver-close' title="Удалить комментарий"
                        onClick={()=>{
                           deleteComment(item.id)
                        }}
                     >
                        <CloseIcon/>
                     </div>
                  </>
                  : '' 
               }
               

            </div>
            { item.ansverVisible ?
               <ComentEdit 
                  title = { `Ответить @${item.user_name}` } 
                  close = { ()=>{commentCommentAnswerClose({key})} }  
                  commenValue = { '' }
                  commentId = { item.id }
                  sendComment = { ()=>{sendCommentAnswer({key})} }
                  name = {'answer' }
                  articleId ={ null }
               />
               : ''
            }
            { item.editVisible ?
               <ComentEdit 
                  title = { 'Редактировать' } 
                  close = { ()=>{commentCommentEditClose({key})} } 
                  commenValue = { item.comment }
                  commentId = { item.id }
                  sendComment = { ()=>{ sendCommentEdit({key})} }
                  name = {'edit'}
               />
               : ''
            }
            { item.replies_comment ? 
               <div className="col mx-5">
                  {item.replies_comment.map((it, index) => (
                     // <div>gggggg</div>
                     <CommentsComment 
                        key = { it.id } 
                        comment = { it } 
                        articleId = { id } 
                        index = { index }
                        parent = { key }
                     />
                  ))}
                 
               </div>
               : ''
            }
         </div> 
         ))
      }
      <div className="d-flex justify-content-center">
         <div className="comments_refresh" title="Обновить комментарии"
            onClick = {()=>updatingСomments()}>
            <CachedIcon className={commentsLoad ? "comments_load":''} />
         </div>
      </div>
      
     
   </>
   );
}
  
export default Comments;