import { BrowserRouter } from 'react-router-dom'
import React from 'react'
import ReactDOM from 'react-dom/client'

import App from './App.jsx'
import Footer from './components/Footer'

// @ts-ignore
ReactDOM.createRoot(document.getElementById('root')).render(
  <React.StrictMode>
    <BrowserRouter basename='/app/'>
      <App />
    </BrowserRouter>
    <Footer />
  </React.StrictMode>
)
