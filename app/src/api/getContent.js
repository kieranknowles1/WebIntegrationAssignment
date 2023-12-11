/**
 * @typedef {Object} Content
 * @property {number} id The unique identifier for the content.
 * @property {string} title The title of the content.
 * NOTE: Some rows have null abstracts in the database.
 * @property {string|null} abstract A short description of the content.
 * @property {string} type The type of content. e.g., 'Paper'
 * @property {string|null} award The award the content won, if any. e.g., 'Best Paper'
 */

/**
 * Binding for the `/api/content/list` endpoint.
 *
 * Returns a list of content alphabetically sorted by title.
 *
 * @author Kieran Knowles
 * @generated Github Copilot was used to assist in writing this code.
 *
 * @param {number | undefined} page The page of 20 results to return. If undefined, returns all results.
 * @param {string | undefined} type The type of content to return. If undefined, returns all types.
 * @returns {Promise<Content[]>} A promise that resolves to an array of content.
 */
export default async function getPreviews (page = undefined, type = undefined) {
  const paramsObj = {}
  if (page !== undefined && page !== null) paramsObj.page = page
  if (type !== undefined && type !== null) paramsObj.type = type

  const params = new URLSearchParams(paramsObj)
  return fetch('https://w20013000.nuwebspace.co.uk/api/content/list?' + params)
    .then(res => res.json())
}
