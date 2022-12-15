import React from 'react';
import './index.scss'

function ErrorMessage({message}) {
  return (
    <div className="error__container" >
      <div className="error__block" >
        <p>{message}</p>
      </div>
    </div>
  );
}
   
export default ErrorMessage;