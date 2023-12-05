import React from 'react'

/**
 * Context for the logged in user. Will be null if the user is not logged in.
 *
 * @author Kieran Knowles
 * @generated Github Copilot was used to assist in writing this code.
 *
 * @typedef {Object} UserContextObject
 * @property {string} token The user's JWT token.
 */

/** @typedef {UserContextObject | null} UserContextValue */

/** @type {React.Context<UserContextValue>} */
const UserContext = React.createContext(null)

export default UserContext
