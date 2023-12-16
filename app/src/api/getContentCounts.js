/**
 * @typedef {Object} ContentCount
 * @property {string} type The type of content.
 * @property {number} count The number of content items of this type.
 */

/**
 * @typedef {Object} ContentCountResponse
 * @property {number} total The total number of content items for all types.
 * @property {ContentCount[]} counts The list of content counts.
 */

/**
 * Binding for the `/api/content/count` endpoint.
 *
 * Returns a list of total counts for each content type.
 *
 * @author Kieran Knowles
 * @generated Github Copilot was used to assist in writing this code.
 * @returns {Promise<ContentCountResponse>} A promise that resolves to the content counts.
 */
export default async function getPreviews () {
  return fetch('https://w20013000.nuwebspace.co.uk/api/content/count')
    .then(res => res.json())
}
