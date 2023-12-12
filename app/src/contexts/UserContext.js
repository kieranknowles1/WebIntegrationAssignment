import React from 'react'

export const LOCAL_STORAGE_USER_KEY = 'user'

/**
 * Tries to get the user from local storage. Returns null if the user is not logged in.
 * @returns {User | null} The user, or null if the user is not logged in.
 */
export function tryGetUserFromLocalStorage () {
  const user = localStorage.getItem(LOCAL_STORAGE_USER_KEY)
  if (!user) return null
  return JSON.parse(user)
}

/**
 * Context for the logged in user. Will be null if the user is not logged in.
 *
 * @author Kieran Knowles
 * @generated Github Copilot was used to assist in writing this code.
 *
 * @typedef {Object} User
 * @property {string} token The user's JWT token.
 */

/** @type {React.Context<User | null>} */
const UserContext = React.createContext(null)

export default UserContext
