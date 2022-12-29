import React from 'react';
import './index.scss'

function VievMessage({message}) {
  return (
    <div className="logout__container">
      <div className="logout" >
        <p>{message}</p>
      </div>
    </div>
  );
}
   
export default VievMessage;