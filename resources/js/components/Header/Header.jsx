import React, {useState} from 'react';
// import React from 'react'
import './Header.scss'
import { Link, useNavigate } from "react-router-dom";
import { getIsAuth, logOutUserAction, getToken, getUserNickName, getUserRoles } from "../../store/userAuth";
import { useDispatch, useSelector } from "react-redux";

import Box from '@mui/material/Box';
import IconButton from '@mui/material/IconButton';
import Typography from '@mui/material/Typography';
import Menu from '@mui/material/Menu';
import Avatar from '@mui/material/Avatar';
import Tooltip from '@mui/material/Tooltip';
import MenuItem from '@mui/material/MenuItem';

import imgAvatar from "../../../image/git.png"
import VievMessage from '../VievMessage'

export const Header = () => {
    const authed = useSelector(getIsAuth);
    const token = useSelector(getToken);
    const roles = useSelector(getUserRoles);
    const nickName = useSelector(getUserNickName)
    const dispatch = useDispatch();
    const navigate = useNavigate();

    const [anchorElUser, setAnchorElUser] = useState(null);
    const [logoutMessage, setLogoutMessage] = useState('');

    const handleOpenUserMenu = (event) => {
        setAnchorElUser(event.currentTarget);
    };

    const handleCloseUserMenu = () => {
        setAnchorElUser(null);
    };

    const logOutUser = async () => {
        setAnchorElUser(null)
        const logout = await dispatch(logOutUserAction(token))
        setLogoutMessage(logout)
        setTimeout(()=>setLogoutMessage(''), 5000)
        console.log("logout - "+  logout)
    }
    
    const userProfileTransfer = (url) => {
        setAnchorElUser(null);
        setTimeout(() => {
            navigate(url)
        }, 1)
    }

    const settings = [
        {title:'Статьи', action: () => userProfileTransfer(`/users/${nickName}/articles`)},
        {title:'Комментарии', action: () => userProfileTransfer(`/users/${nickName}/comments`)},
        {title:'Диалоги', action: handleCloseUserMenu},
        {title:'Закладки', action: handleCloseUserMenu},
        {title:'Как стать автором', action: handleCloseUserMenu},
        {title:'Настройки профиля', action: () => userProfileTransfer("/auth/settigs/profile")},
        {title:'Выход', action: logOutUser}
    ];


    return (
        <>
            <div className= "header">
                <div className="navbar">
                    <div>
                        <a href="/articles/all">
                            <h1>Хабр</h1>
                        </a>
                    </div>
                    {authed ? (
                        <div>
                            <Link to="/login" className="nav-btn">
                                Войти
                            </Link>
                            <Link to="/signup" className="nav-btn ms-3">
                                Регистрация
                            </Link>
                            {logoutMessage === '' ? '' : <VievMessage message ={logoutMessage}/>}
                            {/* <LogoutVievMessage/> */}
                        </div> ) : (
                        <div>
                            {/* <Link className="nav-btn"  onClick = {()=>dispatch(logOutUserAction(token))}>
                            Выйти
                            </Link> */}
                            <Box sx={{ flexGrow: 0 }}>
                                <Tooltip title="Open settings">
                                    <IconButton onClick={handleOpenUserMenu} sx={{ p: 0 }}>
                                        <Avatar alt="Remy Sharp" src={imgAvatar} />
                                    </IconButton>
                                </Tooltip>
                                <Menu
                                    sx={{ mt: '45px' }}
                                    id="menu-appbar"
                                    anchorEl={anchorElUser}
                                    anchorOrigin={{
                                        vertical: 'top',
                                        horizontal: 'right',
                                    }}
                                    keepMounted
                                    transformOrigin={{
                                        vertical: 'top',
                                        horizontal: 'right',
                                    }}
                                    open={Boolean(anchorElUser)}
                                    onClose={handleCloseUserMenu}
                                >
                                    {settings.map((setting, key) => (
                                        <MenuItem key={key} onClick={setting.action}>
                                            <Typography textAlign="center">{setting.title}</Typography>
                                        </MenuItem>
                                    ))}
                                    { roles ? 
                                        <MenuItem  onClick={() => {userProfileTransfer(`admin`)
                                            setTimeout(()=>window.location.reload(),1) 
                                        }}>
                                                <Typography textAlign="center">Перейти в админку</Typography>
                                        </MenuItem> 
                                        :''
                                    }
                                </Menu>
                            </Box>
                                
                        </div>
                    )}
                </div>
            </div>
        </>
    )
}
