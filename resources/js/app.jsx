import React from 'react'
import Router from './router/Routes'
import {Header} from "./components/Header/Header"
import {Layout} from "./router/Layout"
import {Footer} from "./components/Footer/Footer";

const App = () => {
   return (
      <div>
         <Header />
         <Layout />
         <Router />
         <Footer />
      </div>
   )
}
export default App
