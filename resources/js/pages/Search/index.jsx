import React, {useEffect, useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import './search.scss';
import { useDispatch, useSelector } from "react-redux";

import { logInUserTrunk } from "../../store/userAuth/actions";

import {getDbArticlesSearch, setArticleNull} from "../../store/articles";
import {ErrorField} from "../../components/ErrorField";
import ArticlesList from '../../components/Articles/ArticlesList';
import { FormGroup, FormControlLabel, Checkbox } from '@mui/material';

export const Search = () => {
  const [search, setSearch] = useState("");
  const [checkedFresh, setCheckedFresh] = useState(true);
  const [checkedPopular, setCheckedPopular] = useState(false);
  const [articlesVisible, setArticlesVisible] = useState(false);
  const dispatch = useDispatch();
  const navigate = useNavigate(); 

  // const errorList = useSelector(getErrors);
  
  function searchSubmitHandler(event) {
    setSearch(event.target.value);
  }
  function handleChangeFresh(event) {
    setCheckedFresh(event.target.checked);
  }
  function handleChangePopular(event) {
    setCheckedPopular(event.target.checked)
  }

  function clearForm() {
    setSearch("");
  }
//Дизайн, Веб-разработка, Мобильная разработка, Маркетинг
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
  const styleChek = {
    fontSize: "10px",
    backgroundColor: 'aqua',
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
          <FormGroup>
            <FormControlLabel 
              classes = {styleChek}
              className="search-page__form-checked"
              control={<Checkbox defaultChecked 
              checked={checkedFresh}
              onChange={handleChangeFresh}
            />} label="Свежие" />
            <FormControlLabel  
              className="search-page__form-checked"
              control={<Checkbox 
              checked={checkedPopular}
              onChange={handleChangePopular}
            />} label="Популярные" />
          </FormGroup>
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