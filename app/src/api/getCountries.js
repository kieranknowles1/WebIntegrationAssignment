/**
 * Binding for the `/api/country` endpoint.
 *
 * Returns a list of countries alphabetically sorted by name.
 *
 * @author Kieran Knowles
 * @generated Github Copilot was used to assist in writing this code.
 * @returns {Promise<string[]>} A promise that resolves to an array of country names.
 */
export default async function getCountries () {
  return fetch('https://w20013000.nuwebspace.co.uk/api/content/country')
    .then(res => res.json())
}
