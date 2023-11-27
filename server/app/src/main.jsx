import { BrowserRouter } from 'react-router-dom'
import React from 'react'
import ReactDOM from 'react-dom/client'

import App from './App.jsx'
import Footer from './components/Footer'

ReactDOM.createRoot(document.getElementById('root')).render(
  <React.StrictMode>
    <div className='bg-background-default text-foreground-default min-h-screen'>
      <BrowserRouter>
        <App />
      </BrowserRouter>
      <Footer />
    </div>
  </React.StrictMode>
)
