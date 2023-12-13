/**
 * @generated ChatGPT was used to generate this type from an example response.
 * @typedef {Object} AuthorAffiliation
 * @property {number} author_id - The unique identifier for the author.
 * @property {string} author_name - The name of the author.
 * @property {string} country - The country where the author is affiliated.
 * @property {string} city - The city where the author is located.
 * @property {string} institution - The institution to which the author is affiliated.
 * @property {Array<{ id: number, title: string }>} content - An array of content associated with the author,
 *   where each item contains an ID and title.
 */

/**
 * Implementation of the `/api/content/author_affiliation` endpoint.
 * Used internally by the exported functions.
 * @param {number|undefined} content The content ID to get authors for. Mutually exclusive with `country`.
 * @param {string|undefined} country The country to get authors for. Mutually exclusive with `content`.
 */
async function getAuthorAffiliationsImpl (content, country) {
  if (content !== undefined && country !== undefined) {
    throw new Error('content and country are mutually exclusive')
  }

  const paramsObj = {}
  if (content !== undefined) {
    paramsObj.content = content
  } else if (country !== undefined) {
    paramsObj.country = country
  }
  const params = new URLSearchParams(paramsObj)
  return fetch('https://w20013000.nuwebspace.co.uk/api/content/author_affiliation?' + params)
    .then(res => res.json())
}

/**
 * Binding for the `/api/content/author_affiliation` endpoint.
 *
 * Returns a list of authors along with their city, country and institution.
 *
 * @author Kieran Knowles
 * @generated Github Copilot was used to assist in writing this code.
 * @returns {Promise<AuthorAffiliation[]>} A promise that resolves to an array of country names.
 */
export async function getAllAuthorAffiliations () {
  return getAuthorAffiliationsImpl()
}

/**
 * Binding for the `/api/content/author_affiliation` endpoint.
 *
 * Returns a list of authors along with their city, country and institution for a given piece of content.
 *
 * @author Kieran Knowles
 * @generated Github Copilot was used to assist in writing this code.
 * @param {number} content The content ID to get authors for.
 * @returns {Promise<AuthorAffiliation[]>} A promise that resolves to an array of country names.
 */
export async function getContentAuthorAffiliations (content) {
  return getAuthorAffiliationsImpl(content, undefined)
}

/**
 * Binding for the `/api/content/author_affiliation` endpoint.
 *
 * Returns a list of authors along with their city, country and institution for a given country.
 *
 * @author Kieran Knowles
 * @generated Github Copilot was used to assist in writing this code.
 * @param {string} country The country to get authors for.
 * @returns {Promise<AuthorAffiliation[]>} A promise that resolves to an array of country names.
 */
export async function getCountryAuthorAffiliations (country) {
  return getAuthorAffiliationsImpl(undefined, country)
}
