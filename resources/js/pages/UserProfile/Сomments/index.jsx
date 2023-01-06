import React, {useEffect, useState} from 'react';
import { useDispatch, useSelector } from "react-redux";
import ArticlesList from '../../../components/Articles/ArticlesList';
import { getDbArticlesUserProfile, setArticlesPagesUrl} from "../../../store/articles"
import { getDbCommentsProfile, getCommentsProfile}  from "../../../store/comments"
import { getToken, setProfileCommentsBrowse} from "../../../store/userAuth"
import Loader from "../../../components/ui/Loader/Loader"
import ArticlePagination from '../../../components/Articles/ArticlePagination'

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
            {comentsProfile.length > 0 ?
                 comentsProfile.map(comment =>
                    <div className="pages-header">

                    </div>
                    )

                :<div className="pages-header">

                </div>
            }
          <ArticlePagination />
        </>
      }

    </>
  );
}

export default UserProfileComments;

// article_id    :    33
// comment    :    "dfgdfgdfgert44retrtertdgfdfg"
// created_at    :    "3 недели назад"
// id    :    66
// user_avatar    :    "avatars/HDLoOpbzSvLUMjaSQZbNIeU5Iwg2hg2nsH4Lo1AG.jpg"
// user_nick_name    :    "Admin22"
