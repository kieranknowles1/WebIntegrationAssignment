/**
 * @typedef {Object} Preview
 * @property {string} title The title of the preview.
 * @property {string} preview_video The URL of the preview video.
 */

/**
 * Binding for the `/api/content/preview` endpoint.
 *
 * Returns a list of countries alphabetically sorted by name.
 *
 * @author Kieran Knowles
 * @generated Github Copilot was used to assist in writing this code.
 *
 * @param {number | undefined} limit The maximum number of previews to return, defaults to unlimited.
 * @returns {Promise<Preview[]>} A promise that resolves to an array of country names.
 */
export default async function getPreviews (limit = undefined) {
  /** @type {Record<string, string>} */
  const paramsObj = {}
  if (limit !== undefined && limit !== null) paramsObj.limit = limit.toString()
  const params = new URLSearchParams(paramsObj)
  return fetch('https://w20013000.nuwebspace.co.uk/api/content/preview?' + params)
    .then(res => res.json())
}
