import React, {useEffect, useState} from 'react';
import { useSelector, useDispatch } from "react-redux";
import { Link } from "react-router-dom";
import { getDbCommentsArticle, getCommentsArticle, getCommentsLoad, deleteDbCommentArticle,
   updateDbCommentArticle, setMainCommentVisible, setCommentsLoad} from "../../store/comments"
import { getUserId, getToken } from "../../store/userAuth"
import CachedIcon from '@mui/icons-material/Cached';
import './Comments.scss'
import voices from "../../../image/voices.png"
import bookmarks from "../../../image/bookmarks.png"
import CloseIcon from '@mui/icons-material/Close';

function Comments({id}) {
   const [comment, setComment] = useState('')
   const [commentEditValue, setCommentEditValue] = useState('')
   
   const commentsLoad = useSelector(getCommentsLoad)
   
   const dispatch = useDispatch(); 
   const comments =  useSelector(getCommentsArticle);
   const userId =  useSelector(getUserId)
   const token = useSelector(getToken)
   const [commentsCommentsVisible, setCommentsCommentsVisible] = useState(Array.from({length:comments.length}).map(()=>false))
   const [commentsEditVisible, setCommentsEditVisible] = useState(Array.from({length:comments.length}).map(()=>false))
   
   console.log ('commentsCommentsVisible - ', commentsCommentsVisible)
   const updatingСomments = async () =>{
      dispatch(setCommentsLoad)
      // setTimeout(() => setCommentsLoad(prev => !prev), 1000)
      await dispatch( getDbCommentsArticle(id) )
      dispatch(setCommentsLoad)
   }

   function commentSubmitHandler(event) {
      setComment(event.target.value);
   }

   async function sendCommentComment(event) {
      console.log("sendCommentComment")
      event.preventDefault();
      return
   }

   function openCommentAnswer({key, idComment}){
      console.log("openCommentAnswer")
      const copy = Array.from({length:comments.length}).map(()=>false)
      copy[key] = !copy[key] 
      console.log("copy - ", copy, key)
      console.log("key - ", key)
      setCommentsCommentsVisible(copy);
      dispatch( setMainCommentVisible(false) )
   }

   function commentCommentAnswerClose(){
      const copy = Array.from({length:comments.length}).map(()=>false)
      setCommentsCommentsVisible(copy);
      dispatch( setMainCommentVisible(true))
   }

   function commentEdit({key, comment}) {
      // console.log("comment- ", comments)
      const copy = Array.from({length:comments.length}).map(()=>false)
      copy[key] = !copy[key] 
      console.log("copy - ", copy, key)
      console.log("key - ", key)
      setCommentsEditVisible(copy);
      setCommentEditValue(comment)
      dispatch( setMainCommentVisible(false) )
   }

   function commentCommentEditClose() {
      const copy = Array.from({length:comments.length}).map(()=>false)
      setCommentsEditVisible(copy);
      dispatch( setMainCommentVisible(true))
   }

   function commentEditSubmitHandler(event) {
      setCommentEditValue(event.target.value);
   }

   async function sendCommentEdit(event) {
      console.log("sendCommentEdit")
      event.preventDefault();
      const commentId = event.target[0].attributes.dates.value
      console.dir(commentId)
      const logInerror = await dispatch(updateDbCommentArticle({comment:commentEditValue, commentId, token}));
      commentCommentEditClose()
      updatingСomments()
      return
   }

   async function  deleteComment(commentId) { 
      await dispatch(deleteDbCommentArticle({ commentId, token}));
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
                  {/* <div className="article-stats-icons__block">
                     <div className="comments__icons__elem-answer"
                        onClick={()=>{
                           openCommentAnswer({key, idComment: item.id})
                        }}
                     >
                        Ответить
                     </div>
                    
                  </div> */}
                  
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
                              commentEdit({key, comment: item.comment})
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
               <div className='comments__ansver__container  '> 
                  <div className='comments__ansver'>
                     <div className="h4">Ответить @{item.user_name}</div>
                     <div className='comments__ansver-close'
                        onClick={()=>{
                           commentCommentAnswerClose()
                        }}
                     >
                        <CloseIcon/>
                     </div>
                  </div>
                  <form onSubmit={sendComment}>
                     <textarea rows="5"  name="commentComment"
                        value={comment}
                        onChange={commentSubmitHandler}></textarea>
                     { comment =='' ? <input className="mainComment-btn" type="button" value="Отправить" title="Введите комментарий"/>:
                     <input className="mainComment-btn active" type="submit" value="Отправить"/>}
                  </form>
               </div> : ''
            }
            { commentsEditVisible[key] ?
               <div className='comments__ansver__container  '> 
                  <div className='comments__ansver'>
                     <div className="h4">Редактировать</div>
                     <div className='comments__ansver-close'
                        onClick={()=>{
                           commentCommentEditClose()
                        }}
                        >
                        <CloseIcon/>
                     </div>
                  </div>
                  <form onSubmit={sendCommentEdit}>
                     <textarea rows="5"  name="commentComment"
                        value={commentEditValue}
                        dates = {item.id}
                        onChange={commentEditSubmitHandler}></textarea>
                     { commentEditValue =='' ? <input className="mainComment-btn" type="button" value="Сохранить" title="Введите комментарий"/>:
                     <input className="mainComment-btn active" type="submit" value="Сохранить"/>}
                  </form>
               </div> : ''
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
      
      {/* <svg style="width:24px;height:24px" viewBox="0 0 24 24">
         {commentsLoad ? :''}
            <path fill="currentColor" d="M17.65,6.35C16.2,4.9 14.21,4 12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20C15.73,20 18.84,17.45 19.73,14H17.65C16.83,16.33 14.61,18 12,18A6,6 0 0,1 6,12A6,6 0 0,1 12,6C13.66,6 15.14,6.69 16.22,7.78L13,11H20V4L17.65,6.35Z" />
         </svg> 
         comment: "Harum excepturi sunt id qui ipsa. Rerum et in omnis sapiente. Quidem voluptas similique et aut."
         created_at: "вчера в 09:11"
         id: 21
         user_name: "Miss Amelia Becker"
         */
      }
   </>
   );
}
  
export default Comments;