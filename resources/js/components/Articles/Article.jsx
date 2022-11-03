import React from 'react';

function Article({item}) {
  console.log(item);
  return (
      <div className="articke">
        <div className="articke__header d-flex">
          <h4>Name {item.id}</h4>
          <h5>в {item.created_at}</h5>
        </div>
        <div className='articke__title'>
          <h4>{item.title}</h4>
        </div>
        <div className='articke__description'>
          <p>{item.description}</p>
        </div>
        <div className='articke__description'>
          <button>Читать далее</button>
        </div>
      </div>
           
       
    );
  }
  
export default Article;