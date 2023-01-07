import React from 'react';
import { useLocation } from "react-router-dom";
import Avatar from '@mui/material/Avatar';
import { avatarURL } from '../../utils/API'

function CommentHeader({comment}) {
   let location = useLocation();
   let hash = +location.hash.split('_')[1] === comment.id
   console.log('hash -', hash )
   return (
      <>
         <div className={`comments__header ${hash ? 'hash':''}`} id={`comment_${comment.id}`}>
            <Avatar  src={`${avatarURL }${comment.avatar}`} sx={{ width: 25, height: 25 }}/>
            <h4> {comment.user_name}</h4>
            <h5> &emsp;{comment.created_at}&ensp;</h5>
         </div>
      </>
   )
}
export default CommentHeader;