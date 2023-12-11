import { Route, Routes } from 'react-router-dom'
import React from 'react'

import Content from './pages/Content'
import Countries from './pages/Countries'
import Index from './pages/Index'
import PageNotFound from './pages/PageNotFound'

import Login from './components/Login'
/** @typedef {import('./contexts/UserContext').User} User */
import UserContext from './contexts/UserContext'

/**
 * Main app component
 *
 * @author Kieran Knowles
 * @generated Github copilot was used to assist in writing this code
 */
function App () {
  /** @type [User | null, function (User | null): void] */
  const [userContext, setUserContext] = React.useState(null)

  return (
    <UserContext.Provider value={userContext}>
      <div className='float-right'>
        <Login setUserContext={setUserContext} />
      </div><br />
      <Routes>
        <Route path='/' element={<Index />} />
        <Route path='/content' element={<Content />} />
        <Route path='/countries' element={<Countries />} />
        <Route path='*' element={<PageNotFound />} />
      </Routes>
    </UserContext.Provider>
  )
}

export default App
