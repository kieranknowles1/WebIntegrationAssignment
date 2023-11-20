import { Routes, Route } from 'react-router-dom'
import React from 'react'

import Index from './pages/Index'
import PageNotFound from './pages/PageNotFound'

/**
 * Main app component
 *
 * @author Kieran Knowles
 * @generated Github copilot was used to assist in writing this code
 */
function App () {
  return (
    <Routes>
      <Route path='/' element={<Index />} />
      <Route path='*' element={<PageNotFound />} />
    </Routes>
  )
}

export default App
