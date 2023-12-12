/**
 * @typedef {Object} LoginData
 * @property {string} token The token to use to authenticate with the API.
 */

export class InvalidCredentialsError extends Error {
  constructor () {
    super('Invalid email or password')
  }
}

/**
 * Binding for the `/api/token` endpoint.
 *
 * Returns a token that can be used to authenticate with the API.
 *
 * @author Kieran Knowles
 * @generated Github Copilot was used to assist in writing this code.
 * @param {string} email The email address of the user.
 * @param {string} password The password of the user.
 * @returns {Promise<{LoginData}>} A promise that resolves to an array of country names. Rejects with `InvalidCredentialsError` if the credentials are invalid.
 */
export default async function getCountries (email, password) {
  return fetch('https://w20013000.nuwebspace.co.uk/api/token', {
    method: 'GET',
    headers: new Headers({
      Authorization: 'Basic ' + btoa(email + ':' + password)
    })
  }).then(res => {
    if (res.status === 401) {
      throw new InvalidCredentialsError()
    }
    return res
  }).then(res => res.json())
}
