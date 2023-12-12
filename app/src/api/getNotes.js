import InvalidTokenError from '../errors/InvalidTokenError.js'

/**
 * @typedef {Object} Note
 * @property {number} id The ID of the note.
 * @property {number} content_id The ID of the content the note is for.
 * @property {string} content The content of the note.
 */

/**
 * Binding for the `/api/user/note` endpoint.
 *
 * Returns a list of notes the user has made.
 *
 * @author Kieran Knowles
 * @generated Github Copilot was used to assist in writing this code.
 * @param {string} token The token to use to authenticate with the API.
 * @returns {Promise<string[]>} A promise that resolves to an array of country names.
 */
export default async function getNotes (token) {
  return fetch('https://w20013000.nuwebspace.co.uk/api/user/note', {
    method: 'GET',
    headers: new Headers({
      Authorization: 'Bearer ' + token
    })
  }).then(res => {
    if (res.status === 401) {
      throw new InvalidTokenError()
    }
    return res
  }).then(res => res.json())
}
