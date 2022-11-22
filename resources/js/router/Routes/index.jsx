import React from 'react';
import {Route, Routes} from "react-router-dom";
import All from '../../pages/All';
import Design  from '../../pages/Design';
import WebDevelopment from '../../pages/WebDevelopment';
import MobileDevelopment from '../../pages/MobileDevelopment';
import Marketing from '../../pages/Marketing';
import ArticleId from '../../pages/ArticleId'
import { LogIn } from '../../pages/Login';
import { SignUp } from '../../pages/SignUp';
import { ConfirmEmail } from '../../pages/ConfirmEmail';
import { ProtectedRoute } from "../ProtectedRoute";
import { PublicRoute } from "../PublicRoute/Index"
import { useSelector, useDispatch } from "react-redux";
import { getLinksCategoriesAll } from "../../store/categories"
import { Search } from '../../pages/Search';
import {UserSettingsProfile} from '../../pages/UserSettings/Profile/Index';

const Router = () => {
    const dispatch = useDispatch();
    const categoriesLinks = useSelector(getLinksCategoriesAll)
    return (
        <div className="pages">
            <div className="wrapper">
                <div className="pages-container">
                    <Routes>
                        <Route exact path='/' element={<All/>}/>

                        <Route exact path={categoriesLinks[0]} element={<Design/>}/>
                        <Route exact path={categoriesLinks[1]} element={<WebDevelopment/>}/>
                        <Route exact path={categoriesLinks[2]} element={<MobileDevelopment/>}/>
                        <Route exact path={categoriesLinks[3]} element={<Marketing/>}/>
                        <Route element={<PublicRoute />}>
                            <Route exact path='/login' element={<LogIn/>}/>
                            <Route exact path='/signup' element={<SignUp/>}/>
                        </Route>
                        <Route exact path='/search' element={<Search/>}/>
                        <Route exact path='/confirm_email' element={<ConfirmEmail/>}/>
                        <Route exact path='/article/:articleId' element={<ArticleId/>}/>
                        <Route element={<ProtectedRoute />}>
                            <Route exact path='/auth/settigs/profile' element={<UserSettingsProfile/>}/>
                        </Route>
                    </Routes>
                </div>
            </div>
        </div>
    )
}
export default Router
