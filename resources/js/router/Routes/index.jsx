import React from 'react';
import {Route, Routes} from "react-router-dom";
import All from '../../pages/All';
import ArticlesFiltersCategori  from '../../pages/ArticlesFiltersCategori';
import ArticleIdPage from '../../pages/ArticleId'
import { LogIn } from '../../pages/Login';
import { SignUp } from '../../pages/SignUp';
import { ConfirmEmail } from '../../pages/ConfirmEmail';
import { ProtectedRoute } from "../ProtectedRoute";
import { PublicRoute } from "../PublicRoute/Index"
import { useSelector, useDispatch } from "react-redux";
import { getLinksCategoriesAll } from "../../store/categories"
import { Search } from '../../pages/Search';
import { UserSettingsProfile } from '../../pages/UserSettings/Profile';
import ArticlesFiltersTags from '../../pages/ArticlesFiltersTags';
import { ArticleCreate } from '../../pages/UserProfile/ArticleCreate';
import UserProfile from '../../pages/UserProfile'
import UserProfileArticles from '../../pages/UserProfile/Articles'
import UserProfileComments from '../../pages/UserProfile/Сomments'
import UserProfileArticle from '../../pages/UserProfile/Article'

const Router = () => {
    const dispatch = useDispatch();
    const categoriesLinks = useSelector(getLinksCategoriesAll)
    return (
        <div className="pages">
            <div className="wrapper">
                <div className="pages-container">
                    <Routes>
                        <Route exact path='/' element={<All/>}/>
                        <Route exact path='/articles/all' element={<All/>}/>
                        <Route exact path='/articles/categories/:id' element={<ArticlesFiltersCategori/>}/>
                        <Route exact path='/articles/tags/:id' element={<ArticlesFiltersTags/>}/>
                        <Route exact path='/search' element={<Search/>}/>
                        <Route exact path='/confirm_email' element={<ConfirmEmail/>}/>
                        <Route exact path='/article/:articleId' element={<ArticleIdPage/>}/>
                        <Route exact path='/article/:articleId/:comments' element={<ArticleIdPage/>}/>
                        
                        <Route element={<PublicRoute />}>
                            <Route exact path='/login' element={<LogIn/>}/>
                            <Route exact path='/signup' element={<SignUp/>}/>
                        </Route>
    
                        <Route element={<ProtectedRoute />}>
                            <Route exact path='/auth/settigs/profile' element={<UserSettingsProfile/>}/>
                            <Route exact path='/article/create' element={<ArticleCreate/>}/>
                            <Route exact path='/users/:nameUser' element={<UserProfile/>}>
                                <Route exact path='articles' element={<UserProfileArticles/>}/>
                                <Route exact path='comments' element={<UserProfileComments/>}/>
                                <Route exact path='article/:articleId' element={<UserProfileArticle/>}/>
                            </Route>
                        </Route>
                    </Routes>
                </div>
            </div>
        </div>
    )
}
export default Router
