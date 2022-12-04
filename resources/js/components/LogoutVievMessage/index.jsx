import React from 'react';
import './index.scss'
function LogoutVievMessage({logoutMessage}) {
  
   return (
       <div className="logout" >
         <p>{logoutMessage}</p>
       </div>
     );
   }
   
 export default LogoutVievMessage;