import React from 'react'
import getCountries from '../api/getCountries'
/** @typedef {import('../api/getPreview').Preview} Preview */
import getPreviews from '../api/getPreview'

import Fetcher from '../utils/Fetcher'

/**
 * Context to fetch data from the API and cache it between pages.
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
const DataFetcherContext = React.createContext({
  /** @type {Fetcher<string[]>} */
  countries: new Fetcher(getCountries),
  /** @type {Fetcher<Preview>} */
  preview: new Fetcher(async () => {
    const previews = await getPreviews()
    return previews[0]
  })
})

export default DataFetcherContext
