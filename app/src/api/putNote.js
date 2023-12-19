import InvalidTokenError from '../errors/InvalidTokenError.js'

/**
 * Binding for puts to the `/api/user/note` endpoint.
 *
 * Updates a note by its ID.
 *
 * @author Kieran Knowles
 * @generated Github Copilot was used to assist in writing this code.
 * @param {string} token The token to use to authenticate with the API.
 * @param {number} noteId The ID of the note to update. Must belong to the user who owns the token.
 * @param {string} text The content of the note.
 * @returns {Promise<void>} A promise that resolves when the note has been updated. No value is returned.
 */
export default async function putNote (token, noteId, text) {
  const params = new URLSearchParams({
    noteId: noteId.toString()
  })

  return fetch('https://w20013000.nuwebspace.co.uk/api/user/note?' + params, {
    method: 'PUT',
    headers: new Headers({
      Authorization: 'Bearer ' + token
    }),
    body: JSON.stringify({
      text
    })
  }).then(res => {
    if (res.status === 401) {
      throw new InvalidTokenError()
    }
    if (res.status !== 204) {
      throw new Error('Failed to edit note')
    }
    // Nothing to return
  })
}
