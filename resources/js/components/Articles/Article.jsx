import React from 'react';

function Article(item) {
   
  return (
      <>
      <div className='articke__header'>
         <h4>{item.user}</h4>
         <h5>{item.create_at}</h5>
      </div>
      <div className='articke__title'>
         <h4>{item.title}</h4>
         
      </div>
      </>
           
       
    );
  }
  
export default Article;