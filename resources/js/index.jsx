import './bootstrap';
// import './sass/app.acss'
import React from 'react';
import ReactDOM from 'react-dom/client';
import { BrowserRouter } from 'react-router-dom';

import App from './app.jsx';

ReactDOM.createRoot(document.getElementById('app')).render(
   <BrowserRouter>
      <App />
   </BrowserRouter>
)
