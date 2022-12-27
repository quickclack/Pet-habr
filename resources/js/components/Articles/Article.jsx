import React,{ useState} from 'react';
import { useSelector, useDispatch } from "react-redux";
import { Link, useParams } from "react-router-dom";
import ArticleStatsIcons from './ArticleStatsIcons.jsx'
import parse from "html-react-parser";
import { getDbArticleDelete, getDbArticlesUserProfile  } from "../../store/articles"
import { getToken } from "../../store/userAuth"
import   MyConfirm   from "../ui/confirm/MyConfirm"
import   ButtonArticle   from "../ui/Buttons/ButtonArticle"

function Article({item, num}) {
  const [modal, setModal] = useState(false);
  const [value, setValue] = useState(false);
  const params = useParams();
  // console.log("params - ", params)
  const dispatch = useDispatch(); 
  const token = useSelector(getToken)
  const buttons =[
    { link:`/users/${params.nameUser}/article/${item.id}`,
      title: "Читать далее",
      action:()=>{}},
    { link:`/users/${params.nameUser}/article/${item.id}/edit`,
      title: "Редактировать",
      action:()=>{}},
    { link:`/users/${params.nameUser}/articles`,
      title: "Удалить",
      action:() =>setModal(true)}
  ]

  async function  deleteArticle() { 
    console.log("deleteArticle")
    await dispatch(getDbArticleDelete({ articleId : item.id, token}));
    await dispatch(getDbArticlesUserProfile({url:'/api/profile/articles', token}))
 }

  return (
    <div className="article" >
      
      <div className="article__header ">
        <h4> {item.user_name}</h4>
        <h5> &emsp;{item.created_at}&ensp;</h5>
      </div>
      <div className='article__title'>
        <Link to={`/article/${item.id}`} className="nav-btn">
          <h4>{item.title} {item.id}</h4> 
        </Link>
      </div>
      <div className='article__description'>
        {parse(item.description)}
      </div>
        {
          params.nameUser ? 
          <div className='article__button-profile-container'>
            {buttons.map((button, key) =>(
              <ButtonArticle link={button.link} value={button.title} key={key} action={button.action}/>
            ))}
          </div>
          :
          <ButtonArticle link={`/article/${item.id}`} value={'Читать далее'} />
        }
      <ArticleStatsIcons item={item} articleIdSign={false} num={num}/>
      <MyConfirm visible={modal} setVisible={setModal} setYes={deleteArticle}>Вы действительно хотите удалить статью?</MyConfirm>
    </div>
  );
}
export default Article;