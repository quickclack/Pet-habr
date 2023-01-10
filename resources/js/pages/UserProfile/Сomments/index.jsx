import React, {useEffect, useState} from 'react';
import { useDispatch, useSelector } from "react-redux";
import ArticlesList from '../../../components/Articles/ArticlesList';
import { getDbArticlesUserProfile, setArticlesPagesUrl} from "../../../store/articles"
import { getDbCommentsProfile, getCommentsProfile}  from "../../../store/comments"
import { getToken, setProfileCommentsBrowse} from "../../../store/userAuth"
import Loader from "../../../components/ui/Loader/Loader"
import ArticlePagination from '../../../components/Articles/ArticlePagination'
import cl from './Comments.module.css';
import Avatar from '@mui/material/Avatar';
import { avatarURL } from '../../../utils/API'
import {Link} from "react-router-dom"

function UserProfileComments() {
  const [loading, setLoading] = useState(true)
  const dispatch = useDispatch();
  const token = useSelector(getToken)
  const comentsProfile = useSelector(getCommentsProfile)
    console.log("comentsProfile - ", comentsProfile)
  useEffect(()=> {
    console.log("UserProfileComments user profile")
    dispatch(getDbCommentsProfile({token}) );
    dispatch(setProfileCommentsBrowse(true))
    setLoading(false)
    return ()=>{dispatch(setProfileCommentsBrowse(false))}
  },[])



  return (
    <>
      { loading  ? <Loader/> :
        <>
          {comentsProfile ?
            comentsProfile.length > 0 ?
              comentsProfile.map(comment =>
                <div className={cl.comments__container} key={comment.id}>
                  <div  className={cl.comments__article__title}>
                    <h2>{comment.article_title}</h2>
                  </div>
                  <div className={cl.comments__user__info}>
                    <Avatar  src={`${avatarURL }${comment.user_avatar}`} sx={{ width: 25, height: 25 }}/>
                    <h4> &emsp;{comment.user_name}</h4>
                    <h5> &emsp;{comment.created_at}&ensp;</h5>
                  </div>
                  <div>
                    {comment.comment}
                  </div>
                  <div className="article-stats-icons__block">
                    <Link to={`/article/${comment.article_id}/comments#comment_${comment.id}` || '/'}>
                      <div className="comments__icons__elem-answer"
                        
                      > Посмотреть
                      </div>
                    </Link>
                  </div>

                </div>
              )
              :<div className={cl.comments__container}>

              </div>
              :<div className={cl.comments__container}>

              </div>
          }
          <ArticlePagination />
        </>
      }

    </>
  );
}

export default UserProfileComments;



