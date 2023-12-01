import React from 'react'

import Country from '../components/Country'
import LoadingDisplay from '../components/LoadingDisplay'
import getCountries from '../api/getCountries'

/**
 * Countres page
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
function Countres () {
  /** @type {[string[], function (string[]): void]} */
  const [allCountries, setAllCountries] = React.useState([])
  const [query, setQuery] = React.useState('')

  const [countryComponents, setCountryComponents] = React.useState([])
  React.useEffect(() => {
    const filtered = allCountries
      .filter(country => country.toLowerCase().includes(query.toLowerCase()))
    setCountryComponents(filtered.map((country, index) => <Country key={index} name={country} />))
  }, [allCountries, query])

  // TODO: Cache the response when reloading the page
  const [status, setStatus] = React.useState('loading')
  React.useEffect(() => {
    getCountries()
      .then(countries => {
        setAllCountries(countries)
        setStatus('done')
      })
      .catch(err => {
        console.error(err)
        setStatus('error')
      })
  }, [])

  return (
    <main>
      <h1>Countres</h1>
      <input type='text' placeholder='Search' value={query} onChange={e => setQuery(e.target.value)} />
      <LoadingDisplay status={status} />
      <ul>{countryComponents}</ul>
    </main>
  )
}

export default Countres
