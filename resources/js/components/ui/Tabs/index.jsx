import React,{useState, useEffect} from 'react';
import Box from '@mui/material/Box';
import Tab from '@mui/material/Tab';
import Tabs from '@mui/material/Tabs';
import {Link, useNavigate} from "react-router-dom";

export default function LabTabs({link, nickName }) {
   const navigate = useNavigate();
   const [value, setValue] = useState(link);

   const handleChange = (event, newValue) => {
      setValue(newValue);
   };

   useEffect(()=>{ 
      setValue(link);
    },[link])

   const userProfileTransfer = (url) => {
      setTimeout(() => {
         navigate(url)
      }, 1)
   }
   
   const settings = [
      {label:'Профиль', value: 'profile', action:() => userProfileTransfer(`/users/${nickName}/profile`)},
      {label:'Публикации', value: 'articles', action:() => userProfileTransfer(`/users/${nickName}/articles`)},
      {label:'Комментарии', value: 'comments', action:() => userProfileTransfer(`/users/${nickName}/comments`)},
      {label:'Закладки', value: 'bookmarks', action:() => userProfileTransfer(`/users/${nickName}/bookmarks`)},
   ];

   return (
      <Box sx={{ width: '100%', typography: 'body1' }}>
         <Tabs value={value} onChange={handleChange} >
            {settings.map((setting, key) => (
               <Tab key={key} label={setting.label}  value={setting.value} onClick={setting.action}/>
            ))}
         </Tabs>
      </Box>
  );
}