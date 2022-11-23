import React, {useEffect, useState} from 'react';
import { Link } from "react-router-dom";
import CachedIcon from '@mui/icons-material/Cached';
import './Comments.scss'

function Comments() {
   const [comments, setComments] = useState([])
   const [commentsLoad, setCommentsLoad] = useState(false)
   
   const updatingСomments = () =>{
      setCommentsLoad(prev => !prev)
      setTimeout(() => setCommentsLoad(prev => !prev), 1000)
   }
  
   return (
      <>
      <div className="h3">Комментарии</div>
      {
         comments.length == 0 ? 
         <div className="d-flex justify-content-center my-4">
            <small className="text-muted">Здесь пока нет ни одного комментария, вы можете стать первым!</small>
         </div>
         :  comments.map((item) =>(
         <div key = { item.id } className="row">
            <span>
               {`${item.label}`}
            </span>
         </div> 
         ))
         
        
      }
      <div className="d-flex justify-content-center">
         <div className="comments_refresh"  
            onClick = {()=>updatingСomments()}>
            <CachedIcon className={commentsLoad ? "comments_load":''}/>
         </div>
      </div>
      
      {/* <svg style="width:24px;height:24px" viewBox="0 0 24 24">
      {commentsLoad ? :''}
         <path fill="currentColor" d="M17.65,6.35C16.2,4.9 14.21,4 12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20C15.73,20 18.84,17.45 19.73,14H17.65C16.83,16.33 14.61,18 12,18A6,6 0 0,1 6,12A6,6 0 0,1 12,6C13.66,6 15.14,6.69 16.22,7.78L13,11H20V4L17.65,6.35Z" />
      </svg> */}
   </>
   );
}
  
export default Comments;