import React from 'react'
import Router from '../router/Routes'
import {Header} from "./Header/Header"
import {Layout} from "../router/Layout"
const App = () => {
   return (
      <div>
         <Header />
         <Layout />
          <Router />  
      </div>
   )
}
export default App