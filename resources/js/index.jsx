import './bootstrap';
import '../css/app.css'

import React from 'react';

import ReactDOM from 'react-dom/client';
import { Provider } from "react-redux";
import { PersistGate } from "redux-persist/integration/react";
import { BrowserRouter } from 'react-router-dom';
import { persistor, store } from "./store";
import App from './app.jsx';

ReactDOM.createRoot(document.getElementById('app')).render(
   <BrowserRouter>
      <Provider store={store}>
         <PersistGate persistor={persistor}>
         
            <App />
            
         </PersistGate>
      </Provider>
   </BrowserRouter>
  
)
