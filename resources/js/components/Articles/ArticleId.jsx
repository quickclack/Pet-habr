import React, { useEffect, useState } from 'react';
import { useNavigate, useParams, Link } from "react-router-dom";
import { useDispatch, useSelector } from "react-redux";
import { getDbArticle, getArticle, getDbArticleStatus, getDbArticlesUserProfile, getDbArticleDelete } from "../../store/articles"
import { getToken, getUserNickName, } from "../../store/userAuth"
import { getMainCommentVisible } from "../../store/comments"
import './ArticleId.scss'
import ArticleStatsIcons from './ArticleStatsIcons.jsx'
import Comments from '../Comments/Comments';
import MainComment from '../Comments/MainComment';
import Loader from "../ui/Loader/Loader"
import Avatar from '@mui/material/Avatar';
import imgAvatar from "../../../image/git.png"
import { avatarURL } from '../../utils/API'
import   MyConfirm   from "../ui/confirm/MyConfirm"
import   ButtonArticle   from "../ui/Buttons/ButtonArticle"

function ArticleId() {
  const dispatch = useDispatch();
  const [modal, setModal] = useState(false);
  const [modalDraft, setModalDraft] = useState(false);
  const [modalPublish, setModalPublish] = useState(false); 
  const params = useParams();
  const [loading, setLoading] = useState(true)
  const mainCommentVisible = useSelector(getMainCommentVisible);
  const commentsParam = params.comments === 'comments'
  const articleId = parseInt(params.articleId);
  console.log("params - ", params )
  const token = useSelector(getToken)
  let article = useSelector(getArticle);
  let userName = useSelector(getUserNickName)
  const navigate = useNavigate();
  console.log('article - ', article )
  console.log('article - ', Object.entries(article).length !== 0 )
  
  useEffect(()=>{ 
    dispatch(getDbArticle({ url: `/api/article/${articleId}` , token}));
    window.scroll(0, 0);
    setLoading(false)
  },[])

  const buttons =[
    
    { link:`/users/${params.nameUser}/article/${articleId}/edit`,
      title: "Редактировать",
      action:()=>{}},
    { link:`/users/${params.nameUser}/article/${articleId}/${params.status || ''}`,
      title: "Удалить",
      action:() =>setModal(true)}
  ]

  
  async function  deleteArticle() { 
    console.log("deleteArticle")
    await dispatch(getDbArticleDelete({ articleId : articleId, token}));
    
    setTimeout(() => {
      navigate(`/users/${params.nameUser}/articles}`)
    }, 1)
  }

  async function draftArticle() {
    console.log("draftArticle") 
    await dispatch(getDbArticleStatus({ url:`/api/profile/article/${+articleId}/withdraw`, token}));
    await dispatch(getDbArticlesUserProfile({url:'/api/profile/articles?status=10', token}))
    setTimeout(() => {
      navigate(`/users/${params.nameUser}/articles/${params.status || ''}`)
    }, 1)
  }

  async function publishArticle() {
    console.log("publishArticle") 
    await dispatch(getDbArticleStatus({ url:`/api/profile/article/${+articleId}/publish`, 
      token}));
    await dispatch(getDbArticlesUserProfile({url:'/api/profile/articles', token}))
    setTimeout(() => {
      navigate(`/users/${params.nameUser}/articles/${params.status}`)
    }, 1)
  }

  return (
    <>
      { loading  ? <Loader/> :
        Object.entries(article).length !== 0 ? 
        <>
          <div className="pages-header">
            <h3 >articleId { articleId } </h3> 
          </div>
          <div className="articleId">
            <div className="articleId__header ">
              {article.user 
                ? article.user.avatar !== null 
                  ? <Avatar alt="Remy Sharp" src={`${avatarURL}/${article.user.avatar}`}/> 
                  : <Avatar alt="Remy Sharp" src={imgAvatar} />
                :''
              }
              <h4> &emsp;
                { params.nameUser 
                  ? params.nameUser 
                  : article.user.nickName || ''}
              </h4>
              <h5> &emsp;{article.created_at}&ensp;</h5>
            </div>
            <div className='articleId__title'>
              {commentsParam 
                ? <Link to={`/article/${article.id}`} className="nav-btn">
                    <h4>{article.title}</h4>
                  </Link> 
                : <h4>{article.title}</h4>
              }
            </div>
            { commentsParam ? '' :  
              <div className='articleId__description'>
                <p>{article.description}</p>
              </div>
            }
            { commentsParam 
              ? ''
              :  article.image
                ? <div className='articleId__description'>
                    <img src={`${avatarURL}/${article.image}`}/>
                  </div>
                : ''
            }
            <div className='articleId__tags'>
              <p>
                <span className='articleId__tags-span'>Теги:&ensp;</span>
                {
                  article.tags.length > 0 ? article.tags.map((item, key) =>(
                    <Link to={`/articles/tags/${item.id}`} className="nav-btn" key = {item.id}>
                      <span> {item.title}{key < article.tags.length - 1 ? ',' : '' } </span>
                    </Link>
                  )) : ''
                }
              </p>
            </div> 
            {
              params.nameUser 
              ? params.status !== 'moderation' 
                ? <div className='article__button-profile-container'>
                    {buttons.map((button, key) =>(
                      <ButtonArticle link={button.link} value={button.title} key={key} action={button.action}/>
                    ))}
                    { params.status === 'drafts'
                      ? <ButtonArticle link={buttons[1].link} value={'Опубликовать'} action={() =>setModalPublish(true)}/>
                      : <ButtonArticle link={buttons[1].link} value={'В черновики'} action={() =>setModalDraft(true)}/>
                    }
                  </div>
                : ''
              : ''
            }
            <div>
              <MyConfirm visible={modal} setVisible={setModal} setYes={deleteArticle}>Вы действительно хотите удалить статью?</MyConfirm>
              <MyConfirm visible={modalDraft} setVisible={setModalDraft} setYes={draftArticle}>
                Вы действительно хотите статью снять с публикации и сохранить в черновики?
              </MyConfirm>
              <MyConfirm visible={modalPublish} setVisible={setModalPublish} setYes={publishArticle}>
                Вы действительно хотите опубликовать статью ?
              </MyConfirm>
            </div>
          </div>
          { params.status !== 'moderation' 
          ? <>
              <div className="articleId articleId-icons">
                <ArticleStatsIcons articleIdSign={true} item={article}/>
              </div> 
              <div className="articleId ">
                <Comments id = { articleId } />
              </div>
              { mainCommentVisible ? 
                <div className="articleId ">
                  <MainComment articleId={articleId}/>
                </div>: ''
              }
            </>
          : ''
        }
        </> : ''
      }
      
    </>
  );
}
  
export default ArticleId;