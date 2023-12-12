/**
 * Error to be thrown if a token is rejected by the API.
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
export default class InvalidTokenError extends Error {
  constructor () {
    super('Invalid token')
  }
}
