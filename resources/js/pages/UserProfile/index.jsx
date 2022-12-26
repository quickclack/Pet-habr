import React, {useEffect} from 'react';
import { useDispatch, useSelector } from "react-redux";
import { Outlet, Link, useNavigate, useLocation,useParams } from "react-router-dom";

import { getDbArticleDelete, getDbArticlesUserProfile  } from "../../store/articles"
import { getToken, getUser } from "../../store/userAuth"
import imgAvatar from "../../../image/git.png"
import Avatar from '@mui/material/Avatar';
import './profile.scss';
import LabTabs from "../../components/ui/Tabs"
function UserProfile() {
  const param = useParams()
  let location = useLocation();
  const link = location.pathname.split('/')

  // console.log("articles dispatch All param- ", param)
  // console.log("articles dispatch All location- ", location)
  // console.log("articles dispatch All link- ", link[3])
  const dispatch = useDispatch(); 
  const user = useSelector(getUser)
  // useEffect(()=> {
  //   console.log("articles dispatch All")
   
  // },[link ]) 

  return (
      <>
        <div className="profile__container">
          {user.image ? <Avatar alt="Remy Sharp" src={user.image}/> :<Avatar alt="Remy Sharp" src={imgAvatar} />}
          <div className="profile__header">
            <h3 className=""> {user.nickName}</h3>
            <p className=""> { "only"} </p>
          </div> 
          <p> {user.roles ? user.roles : "Пользователь"} </p>
        </div>
        {link[3] === "article"? "" : <div className="profile__menu">
          <LabTabs link={link[3]} nickName={user.nickName}/>
        </div>}
        <Outlet />
        
      </>
    );
  }
  
export default UserProfile;