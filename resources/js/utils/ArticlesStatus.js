export const settings = [
  {title:'Публикации', 
    name:'',
    url:`/api/profile/articles`},
  {title:'Черновики', 
    name:'/drafts',
    url:`/api/profile/articles?status=1`},
  {title:'На модерации', 
    name:'/moderation',
    url:`/api/profile/articles?status=5`},
  {title:'Отклоненные',
    name:'/rejected', 
    url:`/api/profile/articles?status=15`},
 ];

 