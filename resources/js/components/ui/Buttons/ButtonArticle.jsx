import React from 'react';
import { Link } from "react-router-dom";

const ButtonArticle = ({link, value, action}) => {
    return (
        <div className='article__button-profile' 
           
            onClick={action ? ()=>action() : ()=>{}}
        >
            <Link to={ link } className="nav-btn">
                <div className='article__button'>
                    <div >
                        { value }
                    </div>
                </div>
            </Link> 
        </div>

    );
};

export default ButtonArticle;
