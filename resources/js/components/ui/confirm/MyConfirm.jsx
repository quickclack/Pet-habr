import React from 'react';
import  './MyConfirm.scss'
const MyConfirm = ({children, visible, setVisible, setYes  }) => {
    return (
        <div className={ visible ? "confirm__container confirm__active": "confirm__container" } >
            <div className="confirm__window" >
                <div  className="confirm__children">
                    {children}
                </div>
                
                <div className="confirm__cont-button">
                   <div className="confirm__button"
                        onClick={() => {
                        setVisible(false)
                        setYes()    
                    }}
                   >Да</div> 
                   <div className="confirm__button"
                        onClick={() => { 
                        setVisible(false)} }
                   >Нет</div> 
                </div>
            </div>
        </div>
    );
};


export default MyConfirm;
