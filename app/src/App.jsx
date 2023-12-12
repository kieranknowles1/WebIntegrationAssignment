import { Route, Routes } from 'react-router-dom'
import React from 'react'

import Content from './pages/Content'
import Countries from './pages/Countries'
import Index from './pages/Index'
import PageNotFound from './pages/PageNotFound'

import UserContext, { tryGetUserFromLocalStorage } from './contexts/UserContext'
import Login from './components/Login'
import NavMenu from './components/NavMenu'

const navRoutes = [
  { path: '/', element: <Index />, name: 'Home' },
  { path: '/countries', element: <Countries />, name: 'Countries' },
  { path: '/content', element: <Content />, name: 'Content' }
]

const nonNavRoutes = [
  { path: '*', element: <PageNotFound /> }
]

function toRoutes (routes) {
  return routes.map(route =>
    <Route key={route.path} path={route.path} element={route.element} />
  )
}

/**
 * Main app component
 *
 * @author Kieran Knowles
 * @generated Github copilot was used to assist in writing this code
 */
function App () {
  const [userContext, setUserContext] = React.useState(tryGetUserFromLocalStorage())

  return (
    <UserContext.Provider value={userContext}>
      <div className='float-right'>
        <Login setUserContext={setUserContext} />
      </div><br />
      <NavMenu items={navRoutes} />
      <Routes>
        {toRoutes(navRoutes)}
        {toRoutes(nonNavRoutes)}
      </Routes>
    </UserContext.Provider>
  )
}

export default App
