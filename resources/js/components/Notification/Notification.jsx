import React, {useEffect, useState} from 'react';
import { useDispatch, useSelector } from "react-redux";

import { getToken, setProfileCommentsBrowse} from "../../store/userAuth"
import Loader from "../ui/Loader/Loader"
import NotificationId from './NotificationId'
import cl from './Notification.module.css';
import Avatar from '@mui/material/Avatar';
import {setNotificationVisible, setNotificationsVisibleFalse  } from "../../store/notifications"

import {Link} from "react-router-dom"

function Notification({notification, num}) {
  const [visible, setVisible] = useState(notification.visible)
  const dispatch = useDispatch();
  const token = useSelector(getToken)
  
   
  function visibleNotification() {
    dispatch(setNotificationsVisibleFalse())
    // setVisible(!visible )
    dispatch(setNotificationVisible(num))
  }



  return (
    <>
      <div  className={`${cl.notification__container} ${notification.reads==="Не прочитано" ? cl.reads: ''}`}
        onClick={()=>visibleNotification(notification)}
      >
        <div className={cl.text}>
          {notification.id} - {notification.theme} 
        </div>
       {
        notification.visible ? <div>
          <NotificationId id={notification.id}/>
        </div>:""
        }   
      </div>
       
           
    </>
  );
}

export default Notification;



