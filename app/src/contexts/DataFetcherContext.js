import React from 'react'

import Fetcher from '../utils/Fetcher'
import getCountries from '../api/getCountries'
/** @typedef {import('../api/getContent').Content} Content */
import getContent from '../api/getContent'
import getContentCounts from '../api/getContentCounts'
import getContentTypes from '../api/getContentTypes'
/** @typedef {import('../api/getPreview').Preview} Preview */
import getPreviews from '../api/getPreview'

const ALL_TYPES = '__all_types__'

/**
 * Context to fetch data from the API and cache it between pages.
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
const DataFetcherContext = React.createContext({
  countries: new Fetcher(getCountries),

  preview: new Fetcher(async () => {
    const previews = await getPreviews()
    return previews[0]
  }),

  contentCount: new Fetcher(getContentCounts),

  contentTypes: new Fetcher(getContentTypes),

  /**
   * Type -> Page -> Content[]
   * @type {Record<string, Record<number, Fetcher<Content[]>>>}
   */
  _contentFetchers: {},
  /**
   * Content with a given page and type.
   * @param {number} page
   * @param {string | undefined} type If undefined, all types are returned
   * @returns {Fetcher<Content[]>}
   */
  content: function (page, type) {
    const typeKey = type || ALL_TYPES
    if (!this._contentFetchers[typeKey]) this._contentFetchers[typeKey] = {}
    if (!this._contentFetchers[typeKey][page]) {
      this._contentFetchers[typeKey][page] = new Fetcher(async () => await getContent(page, type))
    }
    return this._contentFetchers[typeKey][page]
  }
})

export default DataFetcherContext
