import PropTypes from 'prop-types'
import React from 'react'

import UserContext from '../contexts/UserContext'

/**
 * Login component
 * Must be contained within a UserContext.Provider
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
function Login (props) {
  const context = React.useContext(UserContext)
  const [username, setUsername] = React.useState('')
  const [password, setPassword] = React.useState('')

  function doLogin () {
    // TODO: Get token from API and handle any errors. Using
    // dummy data for now.
    props.setUserContext({
      token: 'Dummy token'
    })
  }

  return (
    <div>
      {context === null
        ? (
          <form>
            <label>Username:
              <input type='text' className='text-background-button' value={username} onChange={e => setUsername(e.target.value)} />
            </label>
            <label>Password:
              <input type='password' className='text-background-button' value={password} onChange={e => setPassword(e.target.value)} />
            </label>
            <input type='submit' value='Login' onClick={e => { e.preventDefault(); doLogin() }} />
          </form>
          )
        : (
          <button onClick={() => props.setUserContext(null)}>Logout</button>
          )}
    </div>
  )
}
Login.propTypes = {
  setUserContext: PropTypes.func.isRequired
}

export default Login
