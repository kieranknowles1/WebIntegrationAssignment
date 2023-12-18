import InvalidTokenError from '../errors/InvalidTokenError.js'

/**
 * Binding for posts to the `/api/user/note` endpoint.
 *
 * Creates a new note for the user and returns its ID.
 *
 * @author Kieran Knowles
 * @generated Github Copilot was used to assist in writing this code.
 * @param {string} token The token to use to authenticate with the API.
 * @param {number} contentId The ID of the content to associate the note with.
 * @param {string} text The content of the note.
 * @returns {Promise<number>} A promise that resolves to the ID of the new note.
 */
export default async function postNote (token, contentId, text) {
  const params = new URLSearchParams({
    contentId: contentId.toString()
  })

  return fetch('https://w20013000.nuwebspace.co.uk/api/user/note?' + params, {
    method: 'POST',
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
    if (res.status !== 200) {
      throw new Error('Failed to create note')
    }
    return res
  }).then(res => res.json())
}
