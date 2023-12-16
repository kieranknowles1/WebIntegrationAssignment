import PropTypes from 'prop-types'
import React from 'react'

import UserContext, { pushUserToLocalStorage, removeUserFromLocalStorage } from '../contexts/UserContext'
import getToken, { InvalidCredentialsError } from '../api/getToken'

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

  function handleLogin () {
    getToken(username, password)
      .then(data => {
        props.setUserContext(data)
        pushUserToLocalStorage(data)

        // Clear the form
        setUsername('')
        setPassword('')
      })
      .catch(err => {
        if (err instanceof InvalidCredentialsError) {
          alert('Invalid username or password.')
        } else {
          // User will expect something to happen, so give a message that explains it
          // isn't their fault.
          console.error(err)
          alert('An error occurred while logging in. Please try again later.')
        }
      })
  }

  function handleLogout () {
    props.setUserContext(null)
    removeUserFromLocalStorage()
  }

  return (
    <div>
      {context === null
        ? (
          <form>
            <label>Email:
              <input type='text' className='text-background-button' value={username} onChange={e => setUsername(e.target.value)} />
            </label>
            <label>Password:
              <input type='password' className='text-background-button' value={password} onChange={e => setPassword(e.target.value)} />
            </label>
            <input type='submit' value='Login' onClick={e => { e.preventDefault(); handleLogin() }} />
          </form>
          )
        : (
          <button onClick={handleLogout}>Logout</button>
          )}
    </div>
  )
}
Login.propTypes = {
  setUserContext: PropTypes.func.isRequired
}

export default Login
