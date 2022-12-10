import React, {useEffect, useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import './search.scss';
import { useDispatch, useSelector } from "react-redux";

import { logInUserTrunk } from "../../store/userAuth/actions";
import { getDbArticlesAll, setArticlesPagesUrl} from "../../store/articles"
import {getDbArticlesSearch, setArticleNull} from "../../store/articles";
import {ErrorField} from "../../components/ErrorField";
import ArticlesList from '../../components/Articles/ArticlesList';
import { FormGroup, FormControlLabel, Checkbox , Radio, RadioGroup, FormControl, FormLabel} from '@mui/material';
import { getCategoriesAll } from "../../store/categories"
import {  getTagsAll, getDbTagsAll,} from "../../store/tags"

export const Search = () => {
  const dispatch = useDispatch();
  
  const [search, setSearch] = useState("");
 
  const [articlesVisible, setArticlesVisible] = useState(false);
  const [serchSort, setSerchSort] = useState('created_at');
  
  const categories = useSelector(getCategoriesAll)
  const tags = useSelector(getTagsAll) 
  const [checkedTags, setCheckedTags] = useState([]);
  const [checkedCategories, setCheckedCategories] = useState([]);
  useEffect(()=> {
    console.log("articles dispatch")
    dispatch( setArticleNull());
    dispatch( getDbTagsAll() );
  },[])
  function searchSubmitHandler(event) {
    setSearch(event.target.value);
  }

  function handleChangeTags(event) {
    const tagsId = event.target.value
    let array = checkedTags
    if (event.target.checked) {
      array.push(tagsId)
    } else {
      const n = array.findIndex((element) => element == tagsId)
      const removed = array.splice(n, 1);
    }
    setCheckedTags(array)
    console.log(event.target.value)
    console.log(event.target.checked)
    console.log(array)
  }
  
  function handleChangeCategories(event) {
    const categoryId = event.target.value
    let array = checkedCategories
    if (event.target.checked) {
      array.push(categoryId)
    } else {
      const n = array.findIndex((element) => element == categoryId)
      const removed = array.splice(n, 1);
    }
    setCheckedCategories(array)
    console.log(event.target.value)
    console.log(event.target.checked)
    console.log(array)
  }

 

  async function searchHandler(event) {
    console.log("searchHandler - " + search)
    event.preventDefault();
    await dispatch( getDbArticlesAll(`/api/articles?search=${search}&sort=${serchSort}&filters[tags]=${checkedTags}&filters[category]=${checkedCategories}`));
    await dispatch(setArticlesPagesUrl(`/api/articles?search=${search}&sort=${serchSort}&filters[tags]=${checkedTags}&filters[category]=${checkedCategories}&`))
    
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
                
              />
            
            <input className="btn search-page__form-btn" type="submit" value="Найти"></input>
          </div>  
          <FormControl>
            <FormLabel id="demo-radio-buttons-group-label">Сортировать</FormLabel>
            <RadioGroup
              row
              aria-labelledby="demo-row-radio-buttons-group-label"
              name="row-radio-buttons-group"
              defaultValue="created_at"
              onChange={serchSortHandler}
              value={serchSort}
            >
              <FormControlLabel value="created_at" control={<Radio />} label="Свежие" />
              <FormControlLabel value="-created_at" control={<Radio />} label="Древние" />
              <FormControlLabel value="views" control={<Radio />} label="Популярные" />
            </RadioGroup>
          </FormControl>
          <div className="row">
            <div class="col-sm">
              <FormGroup>
                <FormLabel id="demo-radio-buttons-group-label">Тэги</FormLabel>
                  {tags.map((option)=>
                    <FormControlLabel key={option.id}
                      classes = {styleChek}
                      className="search-page__form-checked"
                      value={option.id}
                      onChange={handleChangeTags}
                      control={<Checkbox defaultChecked = {false}/>} 
                      label= {option.title} 
                    />
                  )}
              </FormGroup> 
            </div>
            <div class="col-sm">
              <FormGroup>
                <FormLabel id="demo-radio-buttons-group-label">Категории</FormLabel>
                  {categories.map((option)=>
                    <FormControlLabel key={option.id}
                      classes = {styleChek}
                      className="search-page__form-checked"
                      value={option.id}
                      onChange={handleChangeCategories}
                      control={<Checkbox defaultChecked = {false}/>} 
                      label= {option.title} 
                    />
                  )}
              </FormGroup> 
            </div>
          </div>
            {/* {
              errorList &&
                <ErrorField error={errorList}/>
            } */}
           
         </form>
      </div>
      { articlesVisible && <ArticlesList   />}
    </section>
  );
};

