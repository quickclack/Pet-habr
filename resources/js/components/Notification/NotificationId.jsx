import React, {useEffect, useState} from 'react';
import { useDispatch, useSelector } from "react-redux";
import { getToken} from "../../store/userAuth"
import {getDbNotificationsId, getNotificationProfile, setNotification  } from "../../store/notifications"
import cl from './Notification.module.css';
import {Link} from "react-router-dom"

function NotificationId({id}) {
  
  const [visible, setVisible] = useState(true)
  const dispatch = useDispatch();
  const token = useSelector(getToken)
  const notificationId = useSelector(getNotificationProfile)
  console.log(id)
   
  useEffect(()=>{ 
    const res = dispatch(getDbNotificationsId({token, id}))
    console.log('res -', res)
    return () => {dispatch(setNotification (''))}
 },[])

  return (
    <>
      { notificationId !==''
        ?

     
      <div  className={`${cl.notification__container}`}
        
      >
        {notificationId.id} - {notificationId.message}
        {notificationId.article_id || notificationId.comment_id 
          ? <div className="article-stats-icons__block">
              <Link to={`/article/${notificationId.article_id}/comments#comment_${notificationId.comment_id}` || '/'}>
                <div className="comments__icons__elem-answer"
                  
                > Посмотреть
                </div>
              </Link>
            </div>
          : ""
        }
        

      </div>
      :''
      }  
    </>
  );
}

export default NotificationId;



