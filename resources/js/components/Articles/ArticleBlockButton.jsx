import React,{ useState, useEffect} from 'react';
import { useSelector, useDispatch } from "react-redux";
import { Link, useParams } from "react-router-dom";
import ArticleStatsIcons from './ArticleStatsIcons.jsx'
import parse from "html-react-parser";
import { getDbArticleDelete, getDbArticlesUserProfile, getDbArticleStatus  } from "../../store/articles"
import { getToken, getProfileArticles, getProfileArticlesStatus, getUserAvatar } from "../../store/userAuth"
import   MyConfirm   from "../ui/confirm/MyConfirm"
import   ButtonArticle   from "../ui/Buttons/ButtonArticle"
import Avatar from '@mui/material/Avatar';
import imgAvatar from "../../../image/git.png"
import { avatarURL } from '../../utils/API'
import { settings } from '../../utils/ArticlesStatus.js'

function ArticleBlockButton({item, num}) {
  const [modal, setModal] = useState(false);
  const [modalDraft, setModalDraft] = useState(false);
  const [modalPublish, setModalPublish] = useState(false);
  const params = useParams();
  const dispatch = useDispatch(); 
  // console.log("params - ", params)
  const token = useSelector(getToken)
  const userAvatar = useSelector(getUserAvatar)
  const profileArticles = useSelector(getProfileArticles)
  const profileArticlesStatus = useSelector(getProfileArticlesStatus)
  const buttons =[
    { link:`/users/${params.nameUser}/article/${item.id}`,
      title: "Читать далее",
      action:()=>{}},
    { link:`/users/${params.nameUser}/article/${item.id}/edit`,
      title: "Редактировать",
      action:()=>{}},
    { link:`/users/${params.nameUser}/articles${profileArticlesStatus}`,
      title: "Удалить",
      action:() =>setModal(true)}
  ]
  

  async function  deleteArticle() { 
    console.log("deleteArticle")
    await dispatch(getDbArticleDelete({ articleId : item.id, token}));
    await dispatch(getDbArticlesUserProfile({url:`/api/profile/articles${profileArticlesStatus}`, token}))
  }

  async function draftArticle() {
    console.log("draftArticle") 
    await dispatch(getDbArticleStatus({ url:`/api/profile/article/${item.id}/withdraw`, token}));
    await dispatch(getDbArticlesUserProfile({url:'/api/profile/articles?status=10', token}))
  }

  async function publishArticle() {
    console.log("publishArticle") 
    await dispatch(getDbArticleStatus({ url:`/api/profile/article/${item.id}//publish`, 
      token}));
    await dispatch(getDbArticlesUserProfile({url:'/api/profile/articles', token}))
  }

  return (
   <>
      {
         profileArticles 
         ? profileArticlesStatus !== '/moderation' 
         ? <div className='article__button-profile-container'>
               {buttons.map((button, key) =>(
               <ButtonArticle link={button.link} value={button.title} key={key} action={button.action}/>
               ))}
               { profileArticlesStatus === ''
               ? <ButtonArticle link={buttons[2].link} value={'В черновики'} action={() =>setModalDraft(true)}/>
               : <ButtonArticle link={buttons[2].link} value={'Опубликовать'} action={() =>setModalPublish(true)}/>
               }
            </div>
         : <ButtonArticle link={buttons[0].link} value={'Читать далее'} />
         : <ButtonArticle link={`/article/${item.id}`} value={'Читать далее'} />
      }
      <MyConfirm visible={modal} setVisible={setModal} setYes={deleteArticle}>Вы действительно хотите удалить статью?</MyConfirm>
      <MyConfirm visible={modalDraft} setVisible={setModalDraft} setYes={draftArticle}>
        Вы действительно хотите статью снять с публикации и сохранить в черновики?
      </MyConfirm>
      <MyConfirm visible={modalPublish} setVisible={setModalPublish} setYes={publishArticle}>
        Вы действительно хотите опубликовать статью ?
      </MyConfirm>
     
   </>
  );
}
export default ArticleBlockButton;