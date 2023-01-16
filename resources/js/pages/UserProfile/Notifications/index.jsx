import React, { useEffect, useState} from 'react';
import { useParams} from "react-router-dom";

import Notification from '../../../components/Notification/Notification'
import { useDispatch, useSelector } from "react-redux";
import { getToken, } from "../../../store/userAuth"
import Loader from "../../../components/ui/Loader/Loader"
import { getNotificationsProfile, getDbNotifications  } from "../../../store/notifications"
function UserProfileNotifications() {
   const dispatch = useDispatch(); 
   const token = useSelector(getToken);
   const [loading, setLoading] = useState(true)
   const notifications = useSelector(getNotificationsProfile);
   useEffect(()=>{ 
      dispatch(getDbNotifications({token}))
      setLoading(false)
   },[])
   console.log('notifications -',notifications)
   return (
      <>
         { loading  ? <Loader/> 
            : notifications.length > 0 
               ? notifications.map((notification, key) =>
                  <Notification key={notification.id} notification={notification} num={key}/>
                  
               )
               :<div className='articles__block-null'><h2>Уведомлений нет</h2></div>

        

      }
      </>
   )
}

export default UserProfileNotifications