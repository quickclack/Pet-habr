import React, {useEffect, useState} from 'react';
import { Link } from "react-router-dom";
import './Comments.scss'
import { useDispatch, useSelector } from "react-redux";
import { getIsAuth, logOutUserAction, getToken } from "../../store/userAuth";
import { Dining } from '@mui/icons-material';

function MainComment() {
   const [comments, setComments] = useState([])
   const [commentsLoad, setCommentsLoad] = useState(false)
   const authed = useSelector(getIsAuth);
   const dispatch = useDispatch();
   
   async function sendComment(event) {
      console.log("sendComment")
      event.preventDefault();
      const logInerror = await dispatch();
      if (logInerror) {
      return
      } else {
      navigate("/");
      clearForm();
      }
   }
  
   return (
      <>
         {
            !authed ? 
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
               <textarea rows="5"  name="comment"></textarea>
                  <input className="btn" type="submit" value="Отправить"></input>
               </form>
            </div>
         }
      </>
   );
}
  
export default MainComment;