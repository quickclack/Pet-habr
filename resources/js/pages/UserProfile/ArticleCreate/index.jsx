import React, { useState, useEffect} from "react";
import { Link, useNavigate } from "react-router-dom";
import './articleCreate.scss';
import { useDispatch, useSelector } from "react-redux";
import { getCategoriesAll } from "../../../store/categories"
import { getDbTagsAll, getTagsAll } from "../../../store/tags"
import { getDbArticleCreate } from "../../../store/articles"
import { getToken } from "../../../store/userAuth"
import VievMessage from '../../../components/VievMessage'

export const ArticleCreate = () => {
   const dispatch = useDispatch(); 
   const [article, setArticle] = useState({
      title: '', 
      description: '', 
      category_id: '1',
      tag_id: [],
      image:''
   })
   const [message, setMessage] = useState('');
   useEffect(()=> {
      console.log("getDbTagsAll")
      dispatch( getDbTagsAll() );
    },[]) 
   
   const categories = useSelector(getCategoriesAll)
   const tags = useSelector(getTagsAll)
   const token = useSelector(getToken )

   const articleCreate = async (event) =>{
      event.preventDefault();
      dispatch( getDbTagsAll(article));
      const res = await dispatch( getDbArticleCreate({article, token}));
      
      setMessage(res)
      setTimeout(()=>setMessage(''), 5000)

   }

   const setTags = (e)=>{
      const tagsId = e.target.value
      const array = article.tag_id;
      const n = array.findIndex((element) => element == tagsId)
     if (n > 0) {
         const removed = array.splice(n, 1);
         setArticle({...article, tag_id:array})
      } else {
         setArticle({...article, tag_id:[...article.tag_id, tagsId]})
      }
      console.log(article.tag_id)
   }
   return (
      <section className="wrapper">
         <div className="article__edit-page">
            <form onSubmit={articleCreate} enctype="multipart/form-data">
               <div className="article__edit-page-text">Новая статья</div>
               <div className="form">
                  <div className="text-field">
                     <label className="text-field__label" >Название</label>
                     <input className="text-field__input"
                        type="" 
                        value={article.title}
                        onChange={e => setArticle({...article, title:e.target.value })}
                        required
                     />
                  </div>
                  <div className="text-field">
                     <label className="text-field__label" >Описание</label>
                     <textarea rows="5"  name="commentComment"
                        value={article.description}
                        onChange={e => setArticle({...article, description:e.target.value})}
                        required>
                     </textarea>
                     
                  </div>
                  <div className="col-5">
                     <label className="text-field__label" >Категория</label>
                     <select  className="text-field__select"
                        value={article.category_id}
                        onChange={e => setArticle({...article, category_id: e.target.value})}
                        required
                        >
                        {categories.map(option =>
                           <option key={option.id} value={option.id}>
                              {option.title}
                           </option>
                        )}
                     </select>
                  </div>

                  <div className="article__edit-page-message">
                     {message === '' ? '' : <VievMessage message = {message}/>}
                  </div>
                 <div className="col-7">
                     <label className="text-field__label" >Тэги</label>
                     <select  className="text-field__select article__edit-page-myltiselect"
                        defaultValue={article.tag_id}
                        multiple="multiple"
                        >
                        {tags.map(option =>
                           <option key={option.id} value={option.id} onClick={e => setTags(e)}>
                              {option.title}
                           </option>
                        )}
                     </select>
                  </div>
                  <div className="mb-3 w-50">
                     <label className="text-field__label">Изображение</label>
                     <input  className="article__edit-page-img" 
                        type="file"
                        onChange={e => setArticle({...article, image:e.target.files[0] })}
                     />
                  </div>

                  <div className="row justify-content-center">
                     <input className="btn profile-btn" type="submit" value="Загрузить статью"/>
                  </div>
                 
               </div>
            </form>
         </div>
      </section>
  );
};
