import React from 'react';
import './index.scss'

function ProfileMessage({message}) {
  return (
    <div className="message__container">
      <div className="message" >
        <p>{message}</p>
      </div>
    </div>
  );
}
   
export default ProfileMessage;