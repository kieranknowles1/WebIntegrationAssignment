/**
 * Binding for the `/api/content/types` endpoint.
 *
 * Returns a list of content types sorted alphabetically.
 *
 * @author Kieran Knowles
 * @generated Github Copilot was used to assist in writing this code.
 * @returns {Promise<string[]>} A promise that resolves to an array of country names.
 */
export default async function getPreviews () {
  return fetch('https://w20013000.nuwebspace.co.uk/api/content/types')
    .then(res => res.json())
}
