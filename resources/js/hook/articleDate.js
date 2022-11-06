function getArticleDate(created_at) {
   let dayWriting =''
   let dateToday = new Date()
   let dateAtricle = new Date(created_at)
   let dateAtricleObject = getDateObject(dateAtricle)
   let dateTodayObject = getDateObject(dateToday)
   let creationTimeArticle = `${dateAtricle.getHours()}:${dateAtricle.getMinutes()}`
   
   let dayWritingArraySting = {
      0: "сегодня",
      1: "вчера",
      2: "позавчера"
   }
  
   function getDateObject (date) {
      return { year: date.getFullYear(),
               month: date.getMonth(),
               date: date.getDate()
      }
   }

   if (dateAtricleObject.year === dateTodayObject.year 
         && dateAtricleObject.month === dateTodayObject.month
         && (dateTodayObject.date - dateAtricleObject.date) < 3 ) {
      dayWriting = dayWritingArraySting[ dateTodayObject.date - dateAtricleObject.date ]
   } else { dayWriting = created_at}
   
   return {dayWriting, creationTimeArticle}
}
   
export default getArticleDate;