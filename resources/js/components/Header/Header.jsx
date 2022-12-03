import React, {useState} from 'react';
// import React from 'react'
import './Header.scss'
import { Link, useNavigate } from "react-router-dom";
import { getIsAuth, logOutUserAction, getToken } from "../../store/userAuth";
import { useDispatch, useSelector } from "react-redux";

import Box from '@mui/material/Box';
import IconButton from '@mui/material/IconButton';
import Typography from '@mui/material/Typography';
import Menu from '@mui/material/Menu';
import Avatar from '@mui/material/Avatar';
import Tooltip from '@mui/material/Tooltip';
import MenuItem from '@mui/material/MenuItem';

import imgAvatar from "../../../image/git.png"

import LogoutVievMessage from '../LogoutVievMessage'

export const Header = () => {
    const authed = useSelector(getIsAuth);
    const token = useSelector(getToken);
    const dispatch = useDispatch();
    const navigate = useNavigate();

    const [anchorElUser, setAnchorElUser] = useState(null);
    const [logoutVievMessageBoolen, setLogoutVievMessageBoolen] = useState(false);

    const handleOpenUserMenu = (event) => {
        setAnchorElUser(event.currentTarget);
    };

    const handleCloseUserMenu = () => {
        setAnchorElUser(null);
    };

    const settingsProfile = () => {
        setAnchorElUser(null);
        navigate("/auth/settigs/profile")
    }

    const logOutUser = async () => {
        setAnchorElUser(null)
        const logout = await dispatch(logOutUserAction(token))
        setLogoutVievMessageBoolen(true)
        setTimeout(()=>setLogoutVievMessageBoolen(false), 5000)
        console.log("logout - "+  logout)
    }
// settingsProfile
    const settings = [
        {title:'Статьи', action: handleCloseUserMenu},
        {title:'Комментарии', action: handleCloseUserMenu},
        {title:'Диалоги', action: handleCloseUserMenu},
        {title:'Закладки', action: handleCloseUserMenu},
        {title:'Как стать автором', action: handleCloseUserMenu},
        {title:'Настройки профиля', action: settingsProfile},
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
                            {logoutVievMessageBoolen ? <LogoutVievMessage/>:''}
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
                                </Menu>
                            </Box>
                                
                        </div>
                    )}
                </div>
            </div>
        </>
    )
}
