import { Routes, Route } from 'react-router-dom'
import React from 'react'

import Index from './pages/Index'

/**
 * Main app component
 *
 * @author Kieran Knowles
 * @generated Github copilot was used to assist in generating this code
 */
function App () {
  return (
    <Routes>
      <Route path='/' element={<Index />} />
    </Routes>
  )
}

export default App
