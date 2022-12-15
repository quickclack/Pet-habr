import React, {useEffect, useState} from 'react';
import { useSelector, useDispatch } from "react-redux";
import { Link } from "react-router-dom";
import { getDbCommentsArticle, getCommentsArticle, getCommentsLoad, deleteDbCommentArticle,
   updateDbCommentArticle, setMainCommentVisible, setCommentsLoad, setCommentsArticle} from "../../store/comments"
import { getUserId, getToken, getIsAuth } from "../../store/userAuth"
import CachedIcon from '@mui/icons-material/Cached';
import './Comments.scss'
import voices from "../../../image/voices.png"
import bookmarks from "../../../image/bookmarks.png"
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
   const [commentsCommentsVisible, setCommentsCommentsVisible] = useState(Array.from({length:comments.length}).map(()=>false))
   const [commentsEditVisible, setCommentsEditVisible] = useState(Array.from({length:comments.length}).map(()=>false))
      
   useEffect(()=>{
      dispatch(setCommentsArticle(''))
      updatingСomments()
   },[])

   const updatingСomments = async () =>{
      dispatch(setCommentsLoad(true))
      // setTimeout(() => setCommentsLoad(prev => !prev), 1000)
      await dispatch( getDbCommentsArticle(id) )
      dispatch(setCommentsLoad(false))
   }

   function openCommentAnswer({key, idComment}){
      const copy = Array.from({length:comments.length}).map(()=>false)
      copy[key] = !copy[key] 
      setCommentsCommentsVisible(copy);
      const editcopy = Array.from({length:comments.length}).map(()=>false)
      setCommentsEditVisible(editcopy);
      dispatch( setMainCommentVisible(false) )
   }

   function commentCommentAnswerClose(){
      const copy = Array.from({length:comments.length}).map(()=>false)
      setCommentsCommentsVisible(copy);
      dispatch( setMainCommentVisible(true))
   }
   
   function openCommentEdit({key, comment}) {
      const copy = Array.from({length:comments.length}).map(()=>false)
      setCommentsCommentsVisible(copy);
      const editcopy = Array.from({length:comments.length}).map(()=>false)
      editcopy[key] = !editcopy[key] 
      setCommentsEditVisible(editcopy);
      dispatch( setMainCommentVisible(false) )
   }
   
   function commentCommentEditClose() {
      const copy = Array.from({length:comments.length}).map(()=>false)
      setCommentsEditVisible(copy);
      dispatch( setMainCommentVisible(true))
   }
   
   function sendCommentEdit() {
      commentCommentEditClose()
      updatingСomments()
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
                  <div className="article-stats-icons__elem" title={item.rating == undefined ? "Комментарий не оценивали" :"Всего голосов"}>
                     <img src={ voices } alt="" />
                  </div>
                  <div className="article-stats-icons__elem">
                     { item.rating || 0}
                  </div>
               </div>
               {   item.user_id !== userId &&  !authed ?
                  <div className="article-stats-icons__block">
                     <div className="comments__icons__elem-answer"
                        onClick={()=>{
                           openCommentAnswer({key, idComment: item.id})
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
               { item.user_id == userId ? 
                  <>
                     <div className="article-stats-icons__block">
                        <div className="comments__icons__elem-answer"
                           onClick={()=>{
                              openCommentEdit({key, comment: item.comment})
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
            { commentsCommentsVisible[key] ?
               <ComentEdit 
                  title = {`Ответить @${item.user_name}`} 
                  close = {commentCommentAnswerClose}  
                  commenValue = { ''}
                  commentId = { item.id }
                  sendComment = {sendCommentAnswer}
                  name = {'answer'}
                  articleId ={ null }
               />
               : ''
            }
            { commentsEditVisible[key] ?
               <ComentEdit 
                  title = { 'Редактировать' } 
                  close = { commentCommentEditClose } 
                  commenValue = { item.comment }
                  commentId = { item.id }
                  sendComment = { sendCommentEdit }
                  name = {'edit'}
               />
               : ''
            }
            { item.replies_comment ? 
               <div className="col mx-5">
                  {item.replies_comment.map((item) => (
                     // <div>gggggg</div>
                     <CommentsComment key={item.id} comment={item} articleId={id}/>
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