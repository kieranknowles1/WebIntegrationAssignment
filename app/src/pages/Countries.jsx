import React from 'react'

import Country from '../components/Country'
import LoadingDisplay from '../components/LoadingDisplay'

import DataFetcherContext from '../contexts/DataFetcherContext'

/**
 * Countres page
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
function Countres () {
  const [allCountries, setAllCountries] = React.useState(/** @type {string[]} */ ([]))
  const [query, setQuery] = React.useState('')

  const fetcher = React.useContext(DataFetcherContext)

  const [filteredCountries, setFilteredCountries] = React.useState(/** @type {string[]} */ ([]))
  React.useEffect(() => {
    setFilteredCountries(allCountries.filter(country => country.toLowerCase().includes(query.toLowerCase())))
  }, [allCountries, query])

  React.useEffect(() => {
    fetcher.countries.get()
      .then(countries => {
        setAllCountries(countries)
      })
      .catch(err => {
        console.error(err)
      })
  }, [])

  return (
    <main>
      <h1>Countres</h1>
      <input type='text' placeholder='Search' value={query} onChange={e => setQuery(e.target.value)} />
      <LoadingDisplay status={fetcher.countries.status} />
      <ul>{filteredCountries.map(country => <Country key={country} name={country} />)}</ul>
    </main>
  )
}

export default Countres
