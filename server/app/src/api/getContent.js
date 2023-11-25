/**
 * @typedef {Object} Content
 * @property {string} title The title of the content.
 * @property {string} abstract A short description of the content.
 * @property {string} type The type of content. e.g., 'Paper'
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
 * @returns {Promise<Country[]>} A promise that resolves to an array of country names.
 */
export default async function getPreviews (page = undefined, type = undefined) {
  const paramsObj = {}
  if (page !== undefined) paramsObj.page = page
  if (type !== undefined) paramsObj.type = type

  const params = new URLSearchParams(paramsObj)
  return fetch('https://w20013000.nuwebspace.co.uk/api/content/list?' + params)
    .then(res => res.json())
}
