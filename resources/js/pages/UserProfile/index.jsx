import React, {useEffect} from 'react';
import { useDispatch } from "react-redux";
import { Outlet } from "react-router-dom";



function UserProfile() {
  const dispatch = useDispatch(); 
//   useEffect(()=> {
//     console.log("articles dispatch All")
//     dispatch( getDbArticlesAll());
//   },[]) 

  return (
      <>
        <div className="pages-header">
          <h3 >Profile</h3> 
        </div>
        <Outlet />
        {/* <ArticlesList param = {'api/articles?'} /> */}
      </>
    );
  }
  
export default UserProfile;