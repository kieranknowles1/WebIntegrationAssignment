/** @typedef {import('../components/LoadingDisplay').LoadingStatus} LoadingStatus */

/**
 * Class that fetches data from the API and caches it after the first fetch.
 * If a fetch fails, it will be retried on the next call to `get` and the promise will be rejected.
 * @template T The type of data returned by `fetcher`.
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
export default class Fetcher {
  /** @type {T | null} */
  _data = null
  /** @type {LoadingStatus} */
  _status = 'loading'

  get status () { return this._status }

  /**
   * @param {() => Promise<T>} fetcher A function that fetches the data from the API.
   */
  constructor (fetcher) {
    this._fetcher = fetcher
  }

  /**
   * Fetches the data from the API if it hasn't already been fetched.
   * Resolves immediately if the data has already been fetched.
   */
  async get () {
    if (this._data !== null) {
      return this._data
    }

    try {
      this._data = await this._fetcher()
      this._status = 'done'
    } catch (err) {
      this._status = 'error'
      // This is an async function, so throwing acts the same as reject(err)
      throw err
    }

    return this._data
  }
}
