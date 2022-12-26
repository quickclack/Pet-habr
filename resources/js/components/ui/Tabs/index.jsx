import React,{useState, useEffect} from 'react';
import { useSelector, useDispatch } from "react-redux";
import Box from '@mui/material/Box';
import Tab from '@mui/material/Tab';
import Tabs from '@mui/material/Tabs';
import {Link, useNavigate} from "react-router-dom";
import { getUserAmount, getToken, getDbAmountInfoTrunk } from "../../../store/userAuth"

export default function LabTabs({link, nickName }) {
   const navigate = useNavigate();
   const [value, setValue] = useState(link);
   const amount = useSelector(getUserAmount)
   const token = useSelector(getToken)
   console.log (amount)
   const handleChange = (event, newValue) => {
      setValue(newValue);
   };
   const dispatch = useDispatch(); 
   // let [settings, setSettings] = useState([]);
   
   useEffect(()=>{ 
      setValue(link);
      dispatch(getDbAmountInfoTrunk(token))
      // setSettings ();
    },[link])

   const userProfileTransfer = (url) => {
      setTimeout(() => {
         navigate(url)
      }, 1)
   }
   
   const settings = [
      {label:'Профиль', value: 'profile', 
         action:() => userProfileTransfer(`/users/${nickName}/profile`),
         amount: ''},
      {label:'Публикации', value: 'articles', 
         action:() => userProfileTransfer(`/users/${nickName}/articles`),
         amount: amount.amount_articles  ?  amount.amount_articles : ''},
      {label:'Комментарии', value: 'comments', 
         action:() => userProfileTransfer(`/users/${nickName}/comments`),
         amount: amount.amount_comments ?  amount.amount_comments : ''},
      {label:'Закладки', value: 'bookmarks', 
         action:() => userProfileTransfer(`/users/${nickName}/bookmarks`),
         amount: amount.amount_bookmarks ? amount.amount_bookmarks : ''},
   ]
   

   return (
      <Box sx={{ width: '100%', typography: 'body1' }}>
         <Tabs value={value} onChange={handleChange} >
            {settings.map((setting, key) => (
               <Tab key={key} label={`${setting.label}  ${setting.amount}`}  value={setting.value} onClick={setting.action}/>
            ))}
         </Tabs>
      </Box>
  );
}