import React, {useEffect, useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import './search.scss';
import { useDispatch, useSelector } from "react-redux";

import { logInUserTrunk } from "../../store/userAuth/actions";

import {getDbArticlesSearch, setArticleNull} from "../../store/articles";
import {ErrorField} from "../../components/ErrorField";
import ArticlesList from '../../components/Articles/ArticlesList';
export const Search = () => {
  const [search, setSearch] = useState("");
  const [articlesVisible, setArticlesVisible] = useState(false);
  const dispatch = useDispatch();
  const navigate = useNavigate(); 

  // const errorList = useSelector(getErrors);
  
  function searchSubmitHandler(event) {
    setSearch(event.target.value);
  }
  
  function clearForm() {
    setSearch("");
  }

  useEffect(()=> {
    console.log("articles dispatch")
    dispatch( setArticleNull());
  },[])

  async function searchHandler(event) {
    console.log("searchHandler")
    event.preventDefault();
    const logInerror = await dispatch(getDbArticlesSearch({search}));
    
    // if (logInerror) {
    //   return
    // } else {
      
    //   clearForm();
    // }

    setArticlesVisible(true)
    // clearForm();
  }

  return (
    <section className="wrapper">
      <div className="search-page">
         <form onSubmit={searchHandler}>
          <div className="search-page__form">
            
              
              <input className="text-field__input search-page__form-input"
                type="text" 
                placeholder="Поиск"
                value={search}
                onChange={searchSubmitHandler}
                required
              />
            
            <input className="btn search-page__form-btn" type="submit" value="Найти"></input>
          </div>  
            {/* {
              errorList &&
                <ErrorField error={errorList}/>
            } */}
           
         </form>
      </div>
      { articlesVisible && <ArticlesList  param = {`api/search?search=${search}&`} />}
    </section>
  );
};