import InvalidTokenError from '../errors/InvalidTokenError.js'

/**
 * Binding for deletes to the `/api/user/note` endpoint.
 *
 * Creates a new note for the user and returns its ID.
 *
 * @author Kieran Knowles
 * @generated Github Copilot was used to assist in writing this code.
 * @param {string} token The token to use to authenticate with the API.
 * @param {number} noteId The ID of the note to delete. Must belong to the user who owns the token.
 * @returns {Promise<void>} A promise that resolves when the note has been deleted. No value is returned.
 */
export default async function deleteNote (token, noteId) {
  const params = new URLSearchParams({
    noteId: noteId.toString()
  })

  return fetch('https://w20013000.nuwebspace.co.uk/api/user/note?' + params, {
    method: 'DELETE',
    headers: new Headers({
      Authorization: 'Bearer ' + token
    })
  }).then(res => {
    if (res.status === 401) {
      throw new InvalidTokenError()
    }
    if (res.status !== 204) {
      throw new Error('Failed to delete note')
    }
    // Nothing to return
  })
}
