/**
 * Class that fetches data from the API and caches it after the first fetch.
 * @template T The type of data returned by `fetcher`.
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
export default class Fetcher {
  /** @type {T | null} */
  _data = null
  _status = 'loading'
  /** @type {() => Promise<T>} */
  _fetcher = null

  get status () { return this._status }

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
      throw err
    }

    return this._data
  }
}
