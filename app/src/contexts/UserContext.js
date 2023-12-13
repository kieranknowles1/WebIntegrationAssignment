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
 * Stores the user in local storage.
 * @param {User} user The user to store.
 */
export function pushUserToLocalStorage (user) {
  localStorage.setItem(LOCAL_STORAGE_USER_KEY, JSON.stringify(user))
}

/**
 * Clears the user from local storage.
 */
export function removeUserFromLocalStorage () {
  localStorage.removeItem(LOCAL_STORAGE_USER_KEY)
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

const UserContext = React.createContext(/** @type {User | null} */ (null))

export default UserContext
